<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //
    protected $table = 'kelas';
    protected $fillable = ['nama', 'periode_id', 'deleted_at'];


    public function periode()
	{
		return $this->belongsTo('App\Models\Periode', 'periode_id');
	}

	public function siswa()
    {
        return $this->hasMany('App\Models\Siswa', 'kelas_id');
    }

    public function tagihan()
    {
        return $this->hasMany('App\Models\Tagihan', 'kelas_id');
    }
}
