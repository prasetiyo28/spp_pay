<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Periode;
use DataTables;

class KelasController extends Controller
{
    
    // public function index()
    // {
    //     $data['kelas'] = Kelas::all()->whereIn('deleted_at', '1');
    //     $data['periode'] = Periode::all()->whereIn('deleted_at', '1');

    //     return view('dashboard.kelas.all', $data);
    // }

    public function index()
    {
        $kelas = \App\Models\Kelas::all();
        $periode = \App\Models\Periode::all()->where('deleted_at', '1');
       
        return view('dashboard.kelas.all', compact('kelas','periode'));
    }

    
    public function create()
    {
        $data['periode'] = Periode::all()->whereIn('deleted_at', '1');;

        return view('dashboard.kelas.create', $data);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
        ];

        $customAttributes = [
            'periode_id' => 'Periode',
            'nama' => 'Nama',
        ];

        $valid = $request->validate([
            'periode_id' => 'required',
            'nama' => 'required',
        ],$messages,$customAttributes);

        if($valid == true){
            $kelas = new Kelas([
                'nama' => $request->get('nama'),
                'periode_id' => $request->get('periode_id'),
            ]);
            $kelas->save();
        }

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dibuat');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    { 
        $periode = \App\Models\Periode::all()->where('deleted_at', '1');
        $kelas = \App\Models\Kelas::find($id);
       
        return view('dashboard.kelas.update', compact('kelas','periode'));
    }

    public function update(Request $request, $id)
    {
        $kelas = \App\Models\Kelas::find($id);
        $kelas->periode_id = $request->periode_id;
        $kelas->nama = $request->nama;
        $kelas->save();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diubah');
    }

    public function destroy($id)
    {
        $kelas = \App\Models\Kelas::find($id);
        $kelas->update(['deleted_at' => '0']);
        $kelas->save();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }

    public function getData()
    {
        $query = Kelas::select(['id', 'nama', 'periode_id', 'created_at', 'deleted_at'])->where('deleted_at', '1');

        return DataTables::of($query)
            ->addColumn('periode', function($kelas){
                return $kelas->periode->nama;
            })
            ->editColumn('action', function ($kelas) {
                return '<a href="' . route('kelas.edit',$kelas->id) . '"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('kelas.delete',['id'=>$kelas->id]) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['periode', 'action'])
            ->addIndexColumn()
            ->make(true);
    }
}
