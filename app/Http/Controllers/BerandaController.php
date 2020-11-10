<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\DetailTagihan;
use App\Models\Transaksi;
use App\Models\Siswa;
use App\Models\Kelas;
use Carbon\Carbon;
use DataTables;
use File;
use DB;
use Auth;
Use Alert;

class BerandaController extends Controller
{
    public function beranda()
    {
        $id = auth()->user()->id;
        $siswa_id = Siswa::where('user_id',$id)->firstOrFail();
        $detailtagihan = DetailTagihan::join('tagihan', 'tagihan.id', '=', 'detail_tagihan.tagihan_id')
        ->join('siswa', 'siswa.id', '=', 'detail_tagihan.siswa_id')
        ->where('siswa_id', $siswa_id->id)->where('status','belum dibayar')
        ->count();
        
        $body_message = 'silahkan kunjungi halaman tagihan untuk melihat tagihan anda <br/> <a href="'.route('tagihan').'" class="btn btn-info">Lihat Tagihan</a> ';
        if ($detailtagihan > 0) {
            // $routes = routes('tagihan');
            // echo $routes;
             Alert::html('Anda Memiliki Tagihan', $body_message, 'Type');
            
        }

        return view('beranda.beranda');
       
        
    }

    public function tagihan()
    {
        // $data['tagihan'] = Tagihan::all();
        // $data['kelas'] = Kelas::all()->where('deleted_at', '1');
        $id = auth()->user()->id;
        $siswa_id = Siswa::where('user_id',$id)->firstOrFail();
        $data['detailtagihan'] = DetailTagihan::join('tagihan', 'tagihan.id', '=', 'detail_tagihan.tagihan_id')
        ->join('siswa', 'siswa.id', '=', 'detail_tagihan.siswa_id')
        ->where('siswa_id', $siswa_id->id)
        ->where('status','belum dibayar')
        ->get();
        // dd($data['detailtagihan']);
        return view('beranda.tagihan', $data);
        // echo json_encode($data);
    }


    public function history()
    {
        $transaksi = \App\Models\Transaksi::all();
        $siswa = \App\Models\Siswa::all()->where('deleted_at', '1');
        $tagihan = \App\Models\Tagihan::all()->where('deleted_at', '1');

        return view('beranda.history', compact('transaksi','siswa','tagihan'));
    }

    public function profil()
    {
        // $id=Auth::user()->id;
        // $query = DetailTagihan::select('*')->where('siswa_id','=',1)->where('status','=',"status dibayar")->get();
        // $query = DB::table('detail_tagihan')->where('siswa_id', '=', 1)->where('status','=','sudah dibayar')->get();
        // $query = DetailTagihan::all();
        // dd($query);
        return view('beranda.profil');
    }


    public function getData()
    {
        $id = auth()->user()->id;
        $siswa_id = Siswa::where('user_id',$id)->firstOrFail();
        // $data['detailtagihan'] = DetailTagihan::where('siswa_id', $siswa_id->id)->where('status','belum dibayar')->get();

        $query = DetailTagihan::select(['id', 'kode_tagihan','siswa_id','tagihan_id','kelas_id','status'])->where('siswa_id', $siswa_id->id)->where('status','belum dibayar');
        // echo json_encode($query);
       return DataTables::of($query)
            ->addColumn('nama_tagihan', function($ns){
                return  ucwords($ns->getTagihan->nama);
            })
            ->addColumn('jumlah', function($ns){
                return  'Rp. ' . $ns->getTagihan->jumlah;
            })
            ->addColumn('keterangan', function($ns){
                return  $ns->getTagihan->keterangan;
            })
            ->addColumn('kode_tagihan', function($ns){
                return  $ns->kode_tagihan;
            })
            ->editColumn('action', function ($tagihan) {
                return '<a href="' . route('tagihan.edit',$tagihan->id) . '"><span class="fa fa-eye" style="margin-right:5px;"> </span> </a>';
            })
            ->rawColumns([ 'nama_tagihan', 'jumlah','keterangan','action'])
            ->addIndexColumn()
            ->make();
    }


    public function getDataHistory()
    {
        $id = auth()->user()->id;
        $siswa_id = Siswa::where('user_id',$id)->firstOrFail();
        // $data['detailtagihan'] = DetailTagihan::where('siswa_id', $siswa_id->id)->where('status','belum dibayar')->get();

        $query = DetailTagihan::select(['id', 'kode_tagihan','siswa_id','tagihan_id','kelas_id','status'])->where('siswa_id', $siswa_id->id)->where('status','sudah dibayar');
        return DataTables::of($query)
            ->addColumn('kode_tagihan', function($ns){
                return  $ns->kode_tagihan;
            })
            ->addColumn('nama_tagihan', function($ns){
                return  ucwords($ns->getTagihan->nama);
            })
            ->addColumn('jumlah', function($ns){
                return  'Rp. ' . $ns->getTagihan->jumlah;
            })
            ->addColumn('keterangan', function($ns){
                return  $ns->getTagihan->keterangan;
            })
            ->rawColumns([ 'nama_tagihan', 'jumlah','keterangan','action'])
            ->addIndexColumn()
            ->make();
    }

    public function getTagihan()
    {
        $id = auth()->user()->id;
        $siswa_id = Siswa::where('user_id',$id)->firstOrFail();
        $detailtagihan = DetailTagihan::join('tagihan', 'tagihan.id', '=', 'detail_tagihan.tagihan_id')
        ->join('siswa', 'siswa.id', '=', 'detail_tagihan.siswa_id')
        ->where('siswa_id', $siswa_id->id)->where('status','belum dibayar')
        ->count();

        // return view('beranda.beranda');
        
        return $detailtagihan;
        
    }



}
