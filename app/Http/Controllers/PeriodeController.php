<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;
use Carbon\Carbon;
use DataTables;

class PeriodeController extends Controller
{

    public function index(Request $request)
    {
        $periode = \App\Models\Periode::all()->where('deleted_at', '1');

        return view('dashboard.periode.all', compact('periode'));
    }

    public function create()
    {
        return view('dashboard.periode.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'numeric'  => ':attribute harus berupa karakter angka.',
        ];

        $customAttributes = [
            'tgl_mulai' => 'Tanggal Mulai',
            'tgl_selesai' => 'Tanggal Selesai',
            'tahun' => 'Tahun'
        ];

        $valid = $request->validate([
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'tahun' => 'required|numeric'
        ],$messages,$customAttributes);

        if($valid == true){
            if($request->get('is_active') == null){
                $periode = new Periode([
                    'nama' => $request->get('nama'),
                    'tgl_mulai' => Carbon::parse($request->get('tgl_mulai'))->format('y/m/d'),
                    'tgl_selesai' => Carbon::parse($request->get('tgl_selesai'))->format('y/m/d'),
                    'tahun' => $request->get('tahun'),
                    'is_active' => 0,
                    ]);
                    $periode->save();
            }else{
                $periode = new Periode([
                    'nama' => $request->get('nama'),
                    'tgl_mulai' => Carbon::parse($request->get('tgl_mulai'))->format('y/m/d'),
                    'tgl_selesai' => Carbon::parse($request->get('tgl_selesai'))->format('y/m/d'),
                    'tahun' => $request->get('tahun'),
                    'is_active' => $request->get('is_active'),
                ]);
                $periode->save();
            }
        }

        return redirect()->route('periode.index')->with('success', 'Periode berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $periode = \App\Models\Periode::find($id);
        return view('dashboard.periode.update', compact('periode'));
    }


    public function update(Request $request, $id)
    {
        $periode = \App\Models\Periode::find($id);
        $periode->nama = $request->nama;
        $periode->tgl_mulai = $request->tgl_mulai;
        $periode->tgl_selesai = $request->tgl_selesai;
        $periode->tahun = $request->tahun;
        $periode->save();
        return redirect()->route('periode.index')->with('success', 'Periode berhasil diubah');
    }

    public function destroy(Request $request, $id)
    {
        $periode = \App\Models\Periode::find($id);
        $periode->update(['deleted_at' => '0']);
        $periode->save();

        return redirect()->route('periode.index')->with('success', 'Periode berhasil dihapus');
    }


    public function getData()
   {
        $query = Periode::select(['id', 'nama', 'tgl_mulai', 'tgl_selesai', 'tahun', 'is_active', 'created_at', 'deleted_at'])->where('deleted_at', '1');

        return DataTables::of($query)
            ->addColumn('status', function($periode){
                $output = "";
                if($periode->is_active == 1){
                   $output .= '<span class="bg-green">Aktif</span>';
                }else{
                   $output .=  '<span class="bg-yellow">Tidak Aktif</span>';
                }
                return $output;
            })
            ->editColumn('action', function ($periode) {
                return '<a href="' . route('periode.edit',$periode->id) . '"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('periode.delete',['id'=>$periode->id]) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }
}
