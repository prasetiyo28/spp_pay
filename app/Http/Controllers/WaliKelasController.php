<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersStoreRequest;
use App\Models\Tagihan;
use App\Models\Kelas;
use App\Models\WaliKelas as WaliKelas;
use App\Models\Siswa;
use App\User;
use App\Models\DetailTagihan;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\KirimTagihanSiswa;

class WaliKelasController extends Controller
{

    public function index()
    {
        $waliKelas = WaliKelas::all()->where('deleted_at', '1');
        $kelas = Kelas::all()->where('deleted_at', '1');

        return view('dashboard.walikelas.all', compact('kelas','waliKelas'));
    }

    // public function index()
    // {
    //     $data['tagihan'] = Tagihan::all();
    //     return view('dashboard.tagihan.all', $data);
    // }

    public function create()
    {
        $kelas = Kelas::all()->where('deleted_at', '1');
        return view('dashboard.walikelas.create',['kelas' => $kelas]);
        // echo json_encode($kelas);
    }

    public function store(UsersStoreRequest $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.',
            'unique'   => ':attribute sudah digunakan',
        ];

        $customAttributes = [
            'nama' => 'Nama',
            'email' => 'Email',
            'role' => 'Role'
        ];

        $posted = $request->validated($messages,$customAttributes);

        $pwd = "WaliKelas1234";

        $posted['password'] = bcrypt($pwd);
        $posted['role'] = "walikelas";
        // dd($posted);
        $user = User::create($posted);

        // $user_id  = $request->email;
        // $user_id  = $request->email;
        if($user){
            $waliKelas = new WaliKelas;
            $waliKelas->user_id = $user->id;
            $waliKelas->kelas_id = $request->kelas_id;
            $waliKelas->nama_wali_kelas = $request->nama;
            $waliKelas->tempat_lahir = $request->tempat_lahir;
            $waliKelas->tanggal_lahir = $request->tanggal_lahir;
            $waliKelas->jenis_kelamin = $request->jenis_kelamin;
            $waliKelas->alamat = $request->alamat;
            $waliKelas->save();
            return redirect()->route('wali-kelas.index')->with('success', 'Wali Kelas berhasil ditambah');
        }


        return redirect()->route('siswa.index')->with('success', 'Wali Kelas berhasil ditambah');
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
        $query = WaliKelas::select(['id','nama_wali_kelas','kelas_id','tempat_lahir','tanggal_lahir','jenis_kelamin','alamat','deleted_at'])->where('deleted_at', '1')->orderBy('created_at','desc');
        // dd("hai");
       return DataTables::of($query)
            ->addColumn('kelas', function($waliKelas){
                return  $waliKelas->kelas->nama. $waliKelas->kelas->periode->nama;

            })
            ->editColumn('jenis_kelamin', function($waliKelas){
                $output = "";
                if($waliKelas->jenis_kelamin == 'L'){
                    $output .= 'Laki-laki';
                }else{
                    $output .= 'Perempuan';
                }
                return $output;
            })
            ->editColumn('action', function ($waliKelas) {
                return '<a href="' . route('wali-kelas.edit',$waliKelas->id) . '"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('wali-kelas.destroy',$waliKelas->id) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['siswa','action'])
            ->addIndexColumn()
            ->make(true);
    }
}
