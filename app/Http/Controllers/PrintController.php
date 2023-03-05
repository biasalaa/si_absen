<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $siswa = DB::table('siswa')
            ->select('siswa.*', 'jurusan')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->get();
            // dd($request);
        $data = DB::table('absen')
            ->join('siswa', 'absen.id_siswa', 'siswa.id')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->select('absen.*','nama', 'nisn', 'no_kelas', 'kelas', 'jurusan')
            ->where('siswa.kelas', $request->kelas)
            ->orWhere('siswa.no_kelas', $request->no_kelas)
            ->orWhere('jurusan.jurusan', $request->jurusan)
            ->get();
        $waktu = DB::table('waktu')->orderBy('waktu_awal','asc')->get();

        $ruangan = DB::table('ruangan')->get();
        $jurusan = DB::table('jurusan')->get();
        $guru = DB::table('guru')->orderBy('nama_guru','asc')->get();
        $mapel1 = DB::table('mapel')->get();
        $mapel2 = DB::table('mapel')->get();
        return view('print.beritaAcara', compact('jurusan', 'data', 'guru', 'ruangan', 'mapel1','mapel2' ,'waktu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('print.daftarHadir');
    }

    public function printBerita(Request $request)
    {
        $request->validate([
            'ruangan'=>'required',
            'sesi'=>'required',
            'nama_guru'=>'required',
            'mapel1'=>'required',
            'waktu'=>'required',
        ],
        [
            'ruangan.required' => 'ruangan tidak boleh kosong',
            'sesi.required' => 'sesi tidak boleh kosong',
            'nama_guru.required' => 'Pengawas tidak boleh kosong',
            'mapel1.required' => 'mapel1 tidak boleh kosong',
            'mapel.required' => 'mapel tidak boleh kosong',
            'waktu.required' => 'waktu tidak boleh kosong',
        ]);
        // dd('s');
        $siswa = DB::table('siswa')
            ->select('siswa.*', 'jurusan')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->join('ruangan', 'siswa.id_ruangan', 'ruangan.id')
            ->get();
            // dd($request);
            $all = DB::table('absen')
            ->join('siswa', 'absen.id_siswa', 'siswa.id')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->join('ruangan', 'siswa.id_ruangan', 'ruangan.id')
            ->select('absen.*','nama', 'nisn', 'no_kelas', 'kelas', 'jurusan', 'nama_ruangan', 'no_ruangan', 'nama_teknisi', 'sesi')
            ->where('siswa.id_ruangan', $request->ruangan)
            ->where('siswa.sesi', $request->sesi)
            ->whereDate('absen.created_at',date('Y-m-d'))

            // ->groupBy('siswa.id')
            ->count();
             $hadir = DB::table('absen')
            ->join('siswa', 'absen.id_siswa', 'siswa.id')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->select('absen.*','nama', 'nisn', 'no_kelas', 'kelas', 'jurusan')
            ->where('siswa.id_ruangan', $request->ruangan)
            ->where('siswa.sesi', $request->sesi)
            ->where('status','hadir')
            ->whereDate('absen.created_at',date('Y-m-d'))
            ->count();

             $nohadir = DB::table('absen')
            ->join('siswa', 'absen.id_siswa', 'siswa.id')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->select('absen.*','nama', 'nisn', 'no_kelas', 'kelas', 'jurusan')
            ->where('siswa.id_ruangan', $request->ruangan)
            ->where('siswa.sesi', $request->sesi)
            ->where('status','!=','hadir')
            ->whereDate('absen.created_at',date('Y-m-d'))
            ->get();

            $all1 = DB::table('absen')
            ->join('siswa', 'absen.id_siswa', 'siswa.id')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->join('ruangan', 'siswa.id_ruangan', 'ruangan.id')
            ->select('absen.*','nama', 'nisn', 'no_kelas', 'kelas', 'jurusan', 'nama_ruangan', 'no_ruangan', 'nama_teknisi', 'sesi')
            ->where('siswa.id_ruangan', $request->ruangan)
            ->where('siswa.sesi', $request->sesi)
            ->whereDate('absen.created_at',date('Y-m-d'))
            ->get();

            $hadir1 = DB::table('absen')
            ->join('siswa', 'absen.id_siswa', 'siswa.id')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->select('absen.*','nama', 'nisn', 'no_kelas', 'kelas', 'jurusan')
            ->where('siswa.id_ruangan', $request->ruangan)
            ->where('siswa.sesi', $request->sesi);
        if(count($all1) == 0){
            return redirect()->back()->with('error',"Data Yang Sesuai Tidak Ditemukan");
        }

        $jurusan = DB::table('jurusan')->get();
        $guru = DB::table('guru')->where('id',Request()->guru)->first();
        $mapel1 = DB::table('mapel')->where('id',Request()->mapel1)->first();
        $mapel2 = DB::table('mapel')->where('id',Request()->mapel2)->first();
        $waktu = DB::table('waktu')->where('id',Request()->waktu)->first();
        $ruang = DB::table('ruangan')->where('id',Request()->ruangan)->first();
        // return view('dashboard.printpdf',compact('ruang','guru','all','hadir', 'all1', 'mapel1', 'mapel2', 'waktu','nohadir'));
        $pdf = Pdf::loadview('export.BeritaAcara',compact('ruang','guru','all','hadir', 'all1', 'mapel1', 'mapel2', 'waktu','nohadir'));
        $pdf->setPaper('A4','portrait');
        // return $pdf->download($ruang->nama_ruangan .'_sesi'.$all1[0]->sesi.'.pdf');s
        return $pdf->download($ruang->nama_ruangan . '_R_'.($ruang->no_ruangan). '_SESI_'.$all1[0]->sesi.  '.pdf');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
