<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\DetailTagihan;
use App\Models\Transaksi;
use PDF;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index()
    {
        $user = User::count();
        
        if($user == 0){
            return redirect()->route('register');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function profileUpdate()
    {
        return view('dashboard.profile');
    }

    public function laporan_pembayaran()
    {
        $tahun = request()->has('tahun');
        $bulan = request()->has('tahun');
        $kelas = request()->has('tahun');
        $transaksi = Transaksi::where('lunas', 'ya');
        if ($tahun) {
            if (request()->tahun != 'null') {
                echo request()->tahun;
                $transaksi->whereYear('created_at', '=', request()->tahun);
            }
        }

        if ($kelas) {
            if (request()->filled('kelas')) {
                $transaksi->whereHas('siswa', function($q) {
                    $q->where('kelas_id', request()->filled('kelas'));
                });
            }
            
        }

        if ($bulan) {
            if (request()->filled('bulan')) {
               $bulan_val = request()->bulan;
                $year = substr($bulan_val,0,4);
                $month = substr($bulan_val,5,6);

                $transaksi->whereYear('created_at', '=', $year);
                $transaksi->whereMonth('created_at', '=', $month);
            }

        }


        $data['lap_pembayaran'] = $transaksi->get();
        // echo json_encode($data);
        return view('dashboard.laporan.lap_pembayaran',$data);
    }
    
    public function laporan_tunggakan()
    {

        $tahun = request()->has('tahun');
        $bulan = request()->has('tahun');
        $kelas = request()->has('tahun');
        $tunggakan = DetailTagihan::where('status', 'belum dibayar');
        if ($tahun) {
            if (request()->tahun != 'null') {
                echo request()->tahun;
                $tunggakan->whereYear('created_at', '=', request()->tahun);
            }
        }

        if ($kelas) {
            if (request()->kelas != 'null') {
                $tunggakan->where('kelas_id',request()->kelas);
            }
            
        }

        if ($bulan) {
            if (request()->bulan != 'null') {
               $bulan_val = request()->bulan;
                $year = substr($bulan_val,0,4);
                $month = substr($bulan_val,5,6);

                $tunggakan->whereYear('created_at', '=', $year);
                $tunggakan->whereMonth('created_at', '=', $month);
            }

        }

        $data['lap_tunggakan'] = $tunggakan->get();        
        return view('dashboard.laporan.lap_tunggakan',$data);

    }
}
