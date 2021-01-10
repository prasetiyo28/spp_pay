<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $table = 'wali_kelas';
    protected $fillable = ['nama_wali_kelas', 'tempat_lahr','tanggal_lahir','jenis_kelamin','alamat', 'deleted_at'];
    public function kelas()
	{
		return $this->belongsTo('App\Models\Kelas', 'kelas_id');
	}
}
