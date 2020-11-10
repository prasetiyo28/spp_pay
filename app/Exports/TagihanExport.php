<?php

namespace App\Exports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TagihanExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tagihan::all();
    }

    public function map($tagihan): array
    {
        return [
        	$tagihan->nama,
        	$tagihan->jumlah,
        	$tagihan->peserta,
        	$tagihan->keterangan,
        ];
    }

    public function headings(): array
    {
    	return[
    		'NAMA',
    		'JUMLAH',
    		'PESERTA',
    		'KETERANGAN',
    	];
    }
}
