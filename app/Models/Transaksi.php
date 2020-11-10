<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{

    protected $table = 'transaksi';
    protected $fillable = ['id','siswa_id','tagihan_id','kode_transaksi','tgl_transaksi','keterangan','deleted_at','lunas','created_at','updated_at'];

    public function tagihan()
    {
        return $this->belongsTo('App\Models\Tagihan', 'tagihan_id');
    }
    public function detailtagihan()
    {
        return $this->belongsTo('App\Models\DetailTagihan', 'tagihan_id');
    }
    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa', 'siswa_id');
    }
}
