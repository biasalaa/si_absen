<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Ruangan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jurusan_total = Jurusan::count();
        $siswa_total = Siswa::count();
        $ruangan_total = Ruangan::count();
        return view('index',compact('jurusan_total','siswa_total','ruangan_total'));
    } 
}
