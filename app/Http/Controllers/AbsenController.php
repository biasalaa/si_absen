<?php

namespace App\Http\Controllers;

use App\Models\Absen;
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
    $ruangan = DB::table('ruangan')->get();
        return view('absen.siapkanRuangan',compact('ruangan'));
    }
    public function AbsenRuang(Request $request)
    {
        $request->validate([
            'sesi'=>'required',
            'ruangan'=>'required',
        ]);
       $siswa =  DB::table('siswa')
        ->select('siswa.*')
        ->where('id_ruangan',$request->ruangan)
        ->where('sesi',$request->sesi)
        ->get();

        $cek = DB::table('absen')
        ->where('absen.id_siswa',$siswa[0]->id)
        ->whereDate('absen.waktu',date('Y-m-d'))
        ->count()
        ;

        // if($cek == 0){
        if(!$cek){
        return redirect()->back()->with('error', 'Ruangan tidak ditemukan');
        }

        elseif($cek == 0){
            foreach ($siswa as $r ) {
                DB::table('absen')->insert([
                    'id_siswa'=>$r->id,
                    'status'=>5
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
