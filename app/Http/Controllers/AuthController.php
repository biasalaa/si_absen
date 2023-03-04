<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginUI()
    {
        return view('auth.login');
    }
    public function loginUIAdmin()
    {
        return view('auth.admin');
    }

    public function loginSiswa(Type $var = null)
    {
       Request()->validate([
            'nisn' => ['required', 'max:10']
        ]);

        $data = Siswa::where('nisn', Request()->nisn)->first();

        if ($data) {
            $count = Absen::where('id_siswa',$data->id)
            ->whereDate('created_at',date('Y-m-d'))
            ->count();

            if($count > 0){
                Auth::login($data);
                // $siswa = DB::table('siswa')->get();
                // dd($siswa);
                $cek = Siswa::where('id_siswa', Auth::id())->update([
                    "status" => 1,
                ]);
                return redirect('/ujian');
            }else{
            return redirect()->back()->with('alert','Ruangan Belum Terdaftar');

            }
           
        } 
        else {
            return redirect()->back()->with('alert','NISN Tidak Terdaftar');
        }
    }
    public function loginAdmin(Type $var = null)
    {
         Request()->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $username = Request()->username;
        $password = Request()->password;

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect('/');
        } else {
            return redirect()->back();
        }
    }
}
