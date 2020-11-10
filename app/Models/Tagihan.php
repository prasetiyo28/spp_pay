<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';
    protected $fillable = ['id','kode_tagihan', 'nama', 'jumlah', 'peserta','keterangan', 'deleted_at'];

    public function kelas()
	{
		return $this->belongsTo('App\Models\Kelas', 'kelas_id');
	}


	public function siswa()
	{
		return $this->belongsTo('App\Models\Siswa', 'siswa_id');
	}

	public function data()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function transaksi()
	{
		return $this->hasMany('App\Models\Transaksi', 'tagihan_id');
	}
}
