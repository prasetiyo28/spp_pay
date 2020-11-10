<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['id', 'user_id', 'kelas_id', 'nama_siswa', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin' ,'alamat', 'nama_wali', 'deleted_at'];


    public function kelas()
	{
		return $this->belongsTo('App\Models\Kelas', 'kelas_id');
	}
    public function getUser()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
 	public function tagihan()
    {
        return $this->hasMany('App\Models\Tagihan', 'siswa_id');
    }

    // public function user() 
    // {
    //     return $this->hasOne('App\User', 'id_users');
    // }

    public function transaksi()
    {
        return $this->hasMany('App\Models\Transaksi', 'siswa_id');
    }

}
