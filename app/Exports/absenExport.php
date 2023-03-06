<?php

namespace App\Exports;

use App\Invoice;
use App\Models\Absen;
use App\Models\Jenis_Ujian;
use App\Models\Jurusan;
use App\Models\Ruangan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class absenExport implements FromView
{
    function __construct($waktu) {
    }
    public function view(): View
    {
        $waktu = Request()->waktu;
        $jenis_ujian_id = Request()->jenis_ujian;
        $data = Absen::whereDate('created_at',$waktu)->where('id_jenis',$jenis_ujian_id)->get();
        $ruang = Ruangan::all();
        $jurusan = Jurusan::all();
        $jenis_ujian = Jenis_Ujian::find($jenis_ujian_id);

        return view('Export.AbsenSiswa', [
            'ruang'=> $ruang,
            'data' => $data,
            'jurusan'=>$jurusan,
            'jenis_ujian'=>$jenis_ujian,
        ]);
    }
}
