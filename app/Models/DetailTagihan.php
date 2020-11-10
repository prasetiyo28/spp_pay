<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTagihan extends Model
{
    protected $table = 'detail_tagihan';
    protected $fillable = [
        'kode_tagihan','siswa_id','tagihan_id','kelas_id','status'
    ];

    public function getSiswa()
    {
        return $this->belongsTo('App\Models\Siswa', 'siswa_id','id');
    }

    public function getKelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id','id');
    }

    public function getTagihan()
    {
        return $this->belongsTo('App\Models\Tagihan', 'tagihan_id','id');
    }
}
