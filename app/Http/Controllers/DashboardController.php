<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Jurusan;
use App\Models\Mapel;
use App\Models\Ruangan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $sesi = "1";

        if(Request()->sesi != null){
            $sesi = Request()->sesi;
        }

        $jurusan_total = Jurusan::count();
        $siswa_total = Siswa::count();
        $ruangan_total = Ruangan::count();
        $mapel_total = Mapel::count();
<<<<<<< HEAD
        $info_ruangan = Absen::select("ruangan.nama_ruangan")
        ->selectRaw('SUM(CASE WHEN status = "hadir" THEN 1 ELSE 0 END) as total_siswa_hadir ,SUM(CASE WHEN status != "hadir" THEN 1 ELSE 0 END) as total_siswa_tidak_hadir,count(siswa.id) as total_siswa')
        ->join('siswa','absen.id_siswa','siswa.id')
        ->join('ruangan','siswa.id_ruangan','ruangan.id')
        ->groupBy('nama_ruangan')->get();
        $ruangan_siap = [];
        foreach ($info_ruangan as $k ) {
            $ruangan_siap[] =$k->nama_ruangan;
        }
        $ruangan_belum_disiapkan = Ruangan::whereNotIn('nama_ruangan',$ruangan_siap)->get();

        return view('index',compact('jurusan_total','siswa_total','ruangan_total','mapel_total','info_ruangan','ruangan_belum_disiapkan'));
        
    } 
=======
        $absen = DB::table('absen')
        ->join('siswa','absen.id_siswa','siswa.id')
        ->whereDate('absen.created_at',date('Y-m-d'))
        ->where('sesi',$sesi)
        ->get();

        return view('index',compact('jurusan_total','siswa_total','ruangan_total','mapel_total', 'sesi', 'absen'));
    }
>>>>>>> 8209901d4412d0279b40790bb243831f7d070408
}
