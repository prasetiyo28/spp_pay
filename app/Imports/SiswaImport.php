<?php

namespace App\Imports;

use App\User;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteUsers;

class SiswaImport implements ToModel, WithHeadingRow
{
    use Importable;
    
    public function model(array $row)
    {
        $pwd = Str::random(10);
        $user =  User::create([
            'nama' => $row['nama'],
            'email' => $row['email'],
            'password' => bcrypt($pwd),
            'role' => 'siswa',
        ]);
        Mail::to($user->email)->send(new InviteUsers($user, $pwd));
        $create_siswa = new Siswa([
            'user_id' => $user['id'],
            'kelas_id' => $row['id_kelas'],
            'nama_siswa' => $row['nama'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => Carbon::parse($row['tanggal_lahir'])->format('y/m/d'),
            'jenis_kelamin' => $row['jenis_kelamin'],
            'alamat' => $row['alamat'],
            'nama_wali' => $row['nama_wali'],
        ]);

        return[$user,$create_siswa];
    }
}
