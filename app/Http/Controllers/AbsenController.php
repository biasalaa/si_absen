<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Ruangan;
use App\Models\Siswa;
use App\Models\Tahun_Ajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function AbsenRuangUi(){
    $ruangan = Ruangan::all();
        return view('absen.siapkanRuangan',compact('ruangan'));
    }
    public function AbsenRuang(Request $request)
    {
        $request->validate([
            'sesi'=>'required',
            'ruangan'=>'required',
        ]);
       $siswa =  Siswa::where('id_ruangan',$request->ruangan)
        ->where('sesi',$request->sesi)
        ->get();

        if(count($siswa) == 0){
        return redirect()->back()->with('error', 'Data  Siswa Belum Lengkap');

        }

        $cek = Absen::where('id_siswa',$siswa[0]->id)
        ->whereDate('created_at',date('Y-m-d'))
        ->count()
        ;
      

        if($cek != 0){
        return  redirect('/absen-siswa')->with('error', 'Ruangan Sudah Terdaftar');
            
        }elseif($cek == 0){
              $month = date('m');
                if($month <= '06'){
                    $tahun = date('Y',strtotime("-1 Year"))."/".date('Y');;
                    $semester = "genap";
                }else{
                    $tahun = date('Y')."/".date('Y',strtotime("+1 year"));
                    $semester = "ganjil";
                }
                $id_ajaran = Tahun_Ajaran::where('tahun',$tahun)->where('semester',$semester)->first()->id;

                if(!$id_ajaran)return;
        
            foreach ($siswa as $r ) {
                Absen::create([
                    'id_siswa'=>$r->id,
                    'status'=>"belum hadir",
                    'id_ajaran'=>$id_ajaran
                ]);
        }
        return  redirect('/absen-siswa')->with('success', 'Ruangan berhasil di siapkan');
        }
        else{
        return  redirect('/absen-siswa')->with('error', 'Ruangan Sudah Terdaftar');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absen $absen)
    {
        //
    }
}
