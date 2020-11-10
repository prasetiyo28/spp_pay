<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periode';
    protected $fillable = ['nama', 'tgl_mulai', 'tgl_selesai', 'tahun', 'is_active', 'deleted_at'];



    public function kelas()
    {
        return $this->hasMany('App\Models\Kelas', 'periode_id');
    }
}
