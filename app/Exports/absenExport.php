<?php

namespace App\Exports;

use App\Invoice;
use App\Models\absen;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class absenExport implements FromView
{
    function __construct($waktu) {
        $this->waktu = $waktu;
    }
    public function view(): View
    {
        $data =  DB::table('absen')
        ->rightJoin('siswa', 'absen.id_siswa', 'siswa.id')
        ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
        ->whereDate('absen.created_at',$this->waktu)
        ->select('absen.*','nama_siswa', 'nisn', 'no_kelas', 'tingkatan','id_jurusan', 'jurusan','sesi','id_ruangan')
        ->get();

        return view('Export.AbsenSiswa', [
            'ruang'=> DB::table('ruangan')->get(),
            'data' => DB::table('absen')
            ->rightJoin('siswa', 'absen.id_siswa', 'siswa.id')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->whereDate('absen.created_at',$this->waktu)
            ->select('absen.*','nama_siswa', 'nisn', 'no_kelas', 'tingkatan','id_jurusan', 'jurusan','sesi','id_ruangan')
            ->get(),
            'jurusan'=>DB::table('jurusan')->get()
        ]);
    }
}
