<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersStoreRequest;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use App\Models\Siswa;
use App\Models\Kelas;
use App\User;
use Excel;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteUsers;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {

    	$siswa = \App\Models\Siswa::all();
        $kelas = \App\Models\Kelas::all()->where('deleted_at', '1');

        return view('dashboard.siswa.all', compact('siswa','kelas'));
    }

    public function create()
    {
        $kelas = \App\Models\Kelas::all()->where('deleted_at', '1');

        return view('dashboard.siswa.create', compact('kelas'));
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
            'email' => 'Email'
        ];

        $posted = $request->validated($messages,$customAttributes);
        $pwd = Str::random(10);

        $posted['password'] = bcrypt($pwd);

        $user = User::create($posted);
        Mail::to($user->email)->send(new InviteUsers($user, $pwd));

        // $user_id  = $request->email;
        // $user_id  = $request->email;
        if($user){
            $siswa = new \App\Models\Siswa;
            $siswa->user_id = $user->id;
            $siswa->kelas_id = $request->kelas_id;
            $siswa->nama_siswa = $request->nama;
            $siswa->tempat_lahir = $request->tempat_lahir;
            $siswa->tanggal_lahir = $request->tanggal_lahir;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->alamat = $request->alamat;
            $siswa->nama_wali = $request->nama_wali;
            $siswa->save();
            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambah');
        }


        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambah');
    }

    public function importSiswa(Request $request)
    {
        // $rows = Excel::toCollection(new SiswaImport, $request->file('file'));
        $import = new SiswaImport;
        if(!empty($request->hasFile('file'))){
            $this->validate($request, ['file' => 'required']);
            if($request->hasFile('file')){
                $file = $request->file('file');
                try{
                    Excel::import( $import, $file);
                    return redirect()->back()->with(['success' => 'Upload Success']);
                }catch (\Maatwebsite\Excel\Validators\ValidationException $e ){
                    return redirect()->back()->with('message', 'No Biaya already exists or data can not be duplicated');
                }
            }
        }else{
            return redirect()->back()->with(['error' => 'Please choose file before save']);
        }

        // dd($rows);
        // $pwd = Str::random(10);

        // foreach($rows as $row){
        //     $usr = User::create([
        //         'nama' => $row['nama'],
        //         'email' => $row['email'],
        //         'password' => bcrypt($pwd),
        //         'role' => 'siswa',
        //     ]);
        //     $usr->save();
        // }

        return redirect()->back();
    }


    public function getData()
   {
        $query = Siswa::select(['id', 'kelas_id', 'nama_siswa', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin' ,'alamat', 'nama_wali', 'deleted_at'])->where('deleted_at', '1');

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
            ->editColumn('action', function ($siswa) {
                return '<a href="' . route('siswa.edit',$siswa->id) . '"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('siswa.delete',['id'=>$siswa->id]) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['kelas', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function edit($id)
    { 
        $kelas = \App\Models\Kelas::all()->where('deleted_at', '1');
        $siswa = \App\Models\Siswa::find($id);
       
        return view('dashboard.siswa.update', compact('kelas','siswa'));
    }

     public function update(Request $request, $id)
    {
        $siswa = \App\Models\Siswa::find($id);
        $siswa->kelas_id = $request->kelas_id;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->alamat = $request->alamat;
        $siswa->nama_wali = $request->nama_wali;        
        $siswa->save();
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diubah');
    }
     public function destroy($id)
    {
        $siswa = \App\Models\Siswa::find($id);
        $siswa->update(['deleted_at' => '0']);
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
    }


 
}
