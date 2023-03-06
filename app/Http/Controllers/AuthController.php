<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Link;
use App\Models\Siswa;
use App\Models\Tahun_Ajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginUI()
    {
      $this->generateTahunAjaran();
        return view('auth.login');
    }
    public function loginUIAdmin()
    {
      $this->generateTahunAjaran();
        return view('auth.admin');
    }

    public function loginSiswa()
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
                // Auth::login($data);
                // $siswa = DB::table('siswa')->get();
                // dd($siswa);
                $cek = Siswa::find( $data->id)->update([
                    "status" => 1,
                ]);
                $link = Link::first();
                return redirect($link->url);
            }else{
            return redirect()->back()->with('alert','Ruangan Belum Terdaftar');

            }

        }
        else {
            return redirect()->back()->with('alert','NISN Tidak Terdaftar');
        }
    }
    public function loginAdmin()
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

    public function generateTahunAjaran()
    {
          $month = date('m');
        if($month <= '06'){
            $tahun = date('Y',strtotime("-1 Year"))."/".date('Y');;
            $semester = "genap";

        }else{
             $tahun = date('Y')."/".date('Y',strtotime("+1 year"));
            $semester = "ganjil";
        }

        $ada = Tahun_Ajaran::where('tahun',$tahun)->where('semester',$semester)->first();
        if(!$ada){
            Tahun_Ajaran::create([
                'tahun'=>$tahun,
                'semester'=>"ganjil",
            ]);
            Tahun_Ajaran::create([
                'tahun'=>$tahun,
                'semester'=>'genap',
            ]);
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/admin');
    }
}
