<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Siswa;
use App\Models\WaliKelas;
use App\Models\Kelas;
use App\Models\Tagihan;
use App\Models\DetailTagihan;
use App\Models\Transaksi;
use Carbon\Carbon;
use DataTables;
use App\Exports\SiswaExport;
use App\Exports\TagihanExport;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class KepsekController extends Controller
{
    public function index()
    {
        return view('dashboard.kepsek.dashboard');
    }

    public function siswa()
    {

    	$siswa = \App\Models\Siswa::all();
        $kelas = \App\Models\Kelas::all()->where('deleted_at', '1');
        if(auth()->user()->role == 'walikelas'){
            $userId = auth()->user()->id;
            $waliKelas = WaliKelas::where('user_id',$userId)->first();
            $kelas_id = $waliKelas->kelas_id;
            $siswa = $siswa->where('kelas_id',$kelas_id);
        }
        return view('dashboard.kepsek.siswa', compact('siswa','kelas'));
    }

     public function getDataSiswa()
   {
        $query = Siswa::select(['id','nis', 'kelas_id', 'nama_siswa', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin' ,'alamat', 'nama_wali', 'deleted_at'])->where('deleted_at', '1');

       return DataTables::of($query)
            ->addColumn('kelas', function($siswa){
                return  $siswa->kelas->nama. $siswa->kelas->periode->nama;

            })
            ->editColumn('jenis_kelamin', function($siswa){
                $output = "";
                if($siswa->jenis_kelamin == 'L'){
                    $output .= 'Laki-laki';
                }else{
                    $output .= 'Perempuan';
                }
                return $output;
             })
            ->rawColumns(['kelas', 'action'])
            ->addIndexColumn()
            ->make(true);
    }


     public function tagihan()
    {
        $tagihan = \App\Models\Tagihan::all();
        $kelas = \App\Models\Kelas::all()->where('deleted_at', '1');

        return view('dashboard.kepsek.tagihan', compact('tagihan','kelas'));
    }

    public function getDataTagihan()
    {
        $query = Tagihan::select(['id','nama', 'jumlah', 'peserta', 'keterangan','deleted_at'])->where('deleted_at', '1');

       return DataTables::of($query)
            ->addColumn('peserta', function($tagihan){
                if($tagihan->peserta != 'hanya kelas'){
                    $output = 'Semua Kelas';
                }else{
                    $output = 'Hanya Kelas';
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


     public function transaksi()
     {
     	$transaksi = \App\Models\Transaksi::all();
        $siswa = \App\Models\Siswa::all()->where('deleted_at', '1');
        $tagihan = \App\Models\Tagihan::all()->where('deleted_at', '1');

        return view('dashboard.kepsek.transaksi', compact('transaksi','siswa','tagihan'));
    }

     public function getDataTransaksi()
    {
       $query = Transaksi::select(['id','siswa_id','tagihan_id','kode_transaksi','tgl_transaksi','keterangan','deleted_at','created_at','updated_at'])->where('deleted_at', '1');

       return DataTables::of($query)
            ->addColumn('nama_siswa', function($ns){
                return  $ns->siswa->nama_siswa;
            })
            ->addColumn('tagihan', function($tn){
                return  $tn->tagihan->nama;
            })
            ->addColumn('jumlah', function($tj){
                return  $tj->tagihan->jumlah;
            })

            ->rawColumns(['ns','tn','tj','action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function exportsiswa()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function exporttagihan()
    {
        return Excel::download(new TagihanExport, 'tagihan.xlsx');
    }

    public function exporttransaksi()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
}
