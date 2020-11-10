<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::all();
    }

    public function map($transaksi): array
    {
        return [
        	$transaksi->kode_transaksi,
        	$transaksi->siswa->nama_siswa,
        	$transaksi->tagihan->nama,
        	$transaksi->tgl_transaksi,
        	$transaksi->tagihan->jumlah,
        	$transaksi->keterangan,
        ];
    }

    public function headings(): array
    {
    	return[
    		'KODE TRANSAKSI',
    		'NAMA SISWA',
    		'TAGIHAN',
    		'TANGGAL TRANSAKSI',
    		'JUMLAH',
    		'KETERANGAN',
    	];
    }
}
