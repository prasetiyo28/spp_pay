<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::all();
    }

     public function map($siswa): array
    {
        return [
        	$siswa->kelas->nama. ' ' .$siswa->kelas->periode->nama,
            $siswa->nama_siswa,
            $siswa->tempat_lahir,
            $siswa->tanggal_lahir,
            $siswa->jenis_kelamin,
            $siswa->alamat,
            $siswa->nama_wali
        ];
    }

    public function headings(): array
    {
    	return[
    		'KELAS',
    		'NAMA SISWA',
    		'TEMPAT LAHIR',
    		'TANGGAL LAHIR',
    		'JENIS KELAMIN',
    		'ALAMAT',
    		'NAMA WALI'
    	];
    }
}
