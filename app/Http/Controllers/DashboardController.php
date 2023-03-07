<?php

namespace App\Http\Controllers;

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
        $absen = DB::table('absen')
        ->join('siswa','absen.id_siswa','siswa.id')
        ->whereDate('absen.created_at',date('Y-m-d'))
        ->where('sesi',$sesi)
        ->get();

        return view('index',compact('jurusan_total','siswa_total','ruangan_total','mapel_total', 'sesi', 'absen'));
    }
}
