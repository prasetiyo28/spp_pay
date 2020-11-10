<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\DetailTagihan;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\KirimTagihanSiswa;

class TagihanController extends Controller
{

    public function index()
    {
        $tagihan = \App\Models\Tagihan::all();
        $kelas = \App\Models\Kelas::all()->where('deleted_at', '1');
       
        return view('dashboard.tagihan.all', compact('tagihan','kelas'));
    }

    // public function index()
    // {
    //     $data['tagihan'] = Tagihan::all();
    //     return view('dashboard.tagihan.all', $data);
    // }
    
    public function create()
    {
        $kelas = Kelas::all()->where('deleted_at', '1');
        $siswa = Siswa::all()->where('deleted_at', '1');
        return view('dashboard.tagihan.create',['kelas' => $kelas, 'siswa' => $siswa]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jumlah' => 'required|numeric',
            'peserta' => 'required|numeric'
        ]);

        $peserta = $request->peserta;
        
        if($peserta == 1){ //Jika Semua Siswa
            $tagihan = Tagihan::create([
                // 'kode_tagihan' => "TG".Carbon::now()->format('H-is')."-".$s->id,
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'peserta' => 'semua siswa',
                'keterangan' => $request->keterangan,
                ]); //buat tagihan
                $siswa = Siswa::with('getUser')->get(); //Ambil Semua siswa
                foreach($siswa as $s){
                $detail_tagihan = DetailTagihan::create([
                    'siswa_id' => $s->id,
                    'kelas_id' => $s->kelas_id,
                    'tagihan_id' => $tagihan->id,
                    'kode_tagihan' => "TG".Carbon::now()->format('H-is')."-".$s->id,
                    'status' => "belum dibayar"
                ]);//Simpan tagihan sesuai jumlah siswa
                
                if ($s->getUser) {
                    Mail::to($s->getUser->email)->send(new KirimTagihanSiswa($detail_tagihan,$siswa));
                }
                
            }
        }else{ //Hanya kelas
            $kelas = $request->kelas_id;
            $tagihan = Tagihan::create([
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'peserta' => 'hanya kelas',
                'keterangan' => $request->keterangan,
                // 'kode_tagihan' => "TG".Carbon::now()->format('His')."-".Carbon::now()->format('Y/m/d'),
                ]);
            $tagihan_siswa = DetailTagihan::create([
                'kode_tagihan' => "TG".Carbon::now()->format('His')."-".Carbon::now()->format('Y/m/d'),
                'kelas_id' => $kelas,
                'tagihan_id' => $tagihan->id,
                'status' => "belum dibayar"
            ]);
        }
        return redirect()->route('tagihan.index')->with('success', 'Item Tagihan ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tagihan = \App\Models\Tagihan::find($id);
        $kelas = \App\Models\Kelas::all()->where('deleted_at', '1');
        $siswa = \App\Models\Siswa::all()->where('deleted_at', '1');
       
        return view('dashboard.tagihan.update', compact('tagihan','kelas','siswa'));
    }

    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::where('id',$id)->update([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'peserta' => $request->peserta,
            'keterangan' => $request->keterangan
        ]);
        
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil diubah');
    }

    public function destroy(Request $request, $id)
    {
        $tagihan = \App\Models\Tagihan::find($id);
        $tagihan->update(['deleted_at' => '0']);
        $tagihan->save();

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dihapus');
    }

    public function getData()
    {
        $query = Tagihan::select(['id','nama', 'jumlah', 'peserta', 'keterangan','deleted_at'])->where('deleted_at', '1');

       return DataTables::of($query)
            ->addColumn('peserta', function($tagihan){
                // $output = "Semua Siswa";
                if($tagihan->peserta == 'semua siswa'){
                    $output = 'Semua Siswa';
                }else{
                    $output = 'Hanya Beberapa Kelas';
                }
                return $output;
            })
            ->editColumn('action', function ($tagihan) {
                return '<a href="' . route('tagihan.edit',$tagihan->id) . '"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('tagihan.delete',['id'=>$tagihan->id]) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['peserta', 'action'])
            ->addIndexColumn()
            ->make(true);
    }
}
