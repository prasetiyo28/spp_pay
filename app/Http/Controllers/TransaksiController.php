<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;
use DataTables;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Tagihan;
use App\Models\DetailTagihan;
use App\User;
use DB;
use PDF;

class TransaksiController extends Controller
{

    public function index()
    {

        $transaksi = \App\Models\Transaksi::all();
        $siswa = \App\Models\Siswa::all()->where('deleted_at', '1');
        $tagihan = \App\Models\Tagihan::all()->where('deleted_at', '1');

        // $data['transaksi'] = DB::table('detail_tagihan')
        //                         ->join('siswa', 'detail_transaksi.siswa_id','=','siswa.id')
        //                         ->join('kelas', 'users.id', '=', 'contacts.user_id')
        //                         ->join('orders', 'users.id', '=', 'orders.user_id')

        return view('dashboard.transaksi.all', compact('transaksi','siswa','tagihan'));
    }

    public function cariTagihan(Request $request)
    {
        $kode = $request->kode_pembayaran;
        $cek = DetailTagihan::where('kode_tagihan', $kode)->where('status','belum dibayar')->first();
        if($cek != null){
            $getKelas = Siswa::find($cek->siswa_id);
            $data['kelas'] = Kelas::find($getKelas->id);
            $data['tagihan'] = DetailTagihan::with(['getSiswa','getTagihan','getKelas'])->find($cek->id);
            return view('dashboard.transaksi.view', $data);

            // echo json_encode($data);
        }else{
            return redirect()->back()->with('message', 'Tagihan sudah dibayar');
        }

        // dd($coba);

    }

    public function create()
    {
        $transaksi = \App\Models\Transaksi::all();
        $siswa = \App\Models\Siswa::all()->where('deleted_at', '1');
        $tagihan = \App\Models\Tagihan::all()->where('deleted_at', '1');
        return view('dashboard.transaksi.create', compact('transaksi','siswa','tagihan'));
    }

    public function store(Request $request)
    {
         $messages = [
            'required' => ':attribute tidak boleh kosong.',
        ];

        $customAttributes = [
            'siswa_id' => 'Siswa',
            'tagihan_id' => 'Tagihan',
            'kode_transaksi' => 'Kode Transaksi',
            'keterangan' => 'Keterangan',
            'tgl_transaksi' => 'Tanggal Transaksi',
        ];

        $transaksi = new \App\Models\Transaksi;
        $transaksi->siswa_id = $request->siswa_id;
        $transaksi->tagihan_id = $request->tagihan_id;
        $transaksi->kode_transaksi = $request->kode_transaksi;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->total_pembayaran = $request->total_pembayaran;
        $transaksi->tgl_transaksi = Carbon::parse($request->tgl_transaksi)->format('y/m/d');
        $transaksi->lunas = 'ya';
        $transaksi->save();

        $tagihan = DetailTagihan::where('kode_tagihan', $request->kode_transaksi)->first();
        $tagihan->status = 'sudah dibayar';
        $tagihan->save();
        
        // echo json_encode($tagihan);
        return redirect()->route('transaksi.index')->with('success', 'Transaksi created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $transaksi = \App\Models\Transaksi::find($id);
        $siswa = \App\Models\Siswa::all()->where('deleted_at', '1');
        $tagihan = \App\Models\Tagihan::all()->where('deleted_at', '1');
        return view('dashboard.transaksi.update', compact('transaksi','siswa','tagihan'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = \App\Models\Transaksi::find($id);
        $transaksi->siswa_id = $request->siswa_id;
        $transaksi->tagihan_id = $request->tagihan_id;
        $transaksi->tgl_transaksi = $request->tgl_transaksi;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->save();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi update successfully');
    }

    public function destroy($id)
    {
        $transaksi = \App\Models\Transaksi::find($id);
        $transaksi->update(['deleted_at' => '0']);
        $transaksi->save();

        return redirect()->route('transaksi.index')->with('success', 'Siswa deleted successfully');
    }

    public function getData()
    {
       $query = Transaksi::with('detailtagihan')->select(['id','siswa_id','tagihan_id','kode_transaksi','tgl_transaksi','total_pembayaran','keterangan','lunas','deleted_at','created_at','updated_at'])->where('deleted_at', '1')->where('lunas','ya');

       return DataTables::of($query)
            ->addColumn('kode_transaksi', function($ns){
                return  $ns->kode_transaksi;
            })
            ->addColumn('nama_siswa', function($ns){
                return  $ns->siswa->nama_siswa;
            })
            ->addColumn('tagihan', function($ns){
                return  $ns->tagihan->nama;
            })
            ->addColumn('tgl_transaksi', function($ns){
                return  $ns->tgl_transaksi;
            })
            ->addColumn('jumlah', function($ns){
                return  $ns->total_pembayaran;
            })
            ->addColumn('keterangan', function($ns){
                return  $ns->keterangan;
            })
            ->addColumn('action', function($ns){
                return '<a href="' . route('transaksi.invoice',$ns->id) . '" class="btn btn-success btn-xs bg-green"><span class="fa fa-print" style="margin-right:5px;"> </span>Cetak </a></a>';
            })
            ->rawColumns(['kode_transaksi','nama_siswa','tagihan','tgl_transaksi','jumlah','keterangan','action'])
            ->addIndexColumn()
            ->make(true);
    }
    
    public function cetakInvoice($id)
    {
        $data['invoice'] = Transaksi::find($id);
        return view('dashboard.transaksi.invoice',$data);
    }
    
    public function printInvoice($id)
    {
        $data['invoice'] = Transaksi::find($id);
        return view('dashboard.transaksi.cetak_invoice',$data);
        // $pdf = PDF::loadView('dashboard.transaksi.cetak_invoice', $data);
        // return $pdf->stream('Invoice-SPP');
    }
}
