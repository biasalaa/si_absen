<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
use Dompdf\Dompdf;
use App\Exports\absenExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\Jenis_Ujian;
use App\Models\Mapel;
use App\Models\Waktu;
use App\Models\Jurusan;
use App\Models\Ruangan;
use App\Models\Siswa;
use App\Models\Tahun_Ajaran;


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
        $data = Absen::whereHas('siswa',function($query)use($request)
            {
                $query->where('tingkatan',Request()->kelas);
                $query->orWhere('no_kelas',Request()->no_kelas);
            })->get();

        $waktu = Waktu::orderBy('waktu_awal','asc')->get();
        $ruangan = Ruangan::all();
        $jurusan = Jurusan::all();
        $guru = Guru::orderBy('nama_guru','asc')->get();
        $mapel1 = Mapel::all();
        $mapel2 = Mapel::all();
        $jenis_ujian = Jenis_Ujian::all();

        return view('print.beritaAcara', compact('jurusan', 'data', 'guru', 'ruangan', 'mapel1','mapel2' ,'waktu','jenis_ujian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftarHadir()
    {
        $jenis_ujian = Jenis_Ujian::all();
        return view('print.daftarHadir', compact('jenis_ujian'));
    }

    public function printBerita(Request $request)
    {
        $request->validate([
            'ruangan'=>'required',
            'nama_guru'=>'required',
            'mapel1'=>'required',
            'waktu'=>'required',
            'jenis_ujian'=>'required',
        ],
        [
            'ruangan.required' => 'ruangan tidak boleh kosong',
            'nama_guru.required' => 'Pengawas tidak boleh kosong',
            'mapel1.required' => 'mapel1 tidak boleh kosong',
            'mapel.required' => 'mapel tidak boleh kosong',
            'waktu.required' => 'waktu tidak boleh kosong',
            'jenis_ujian.required' => 'Jenis Ujian tidak boleh kosong',
        ]);

        
            $id_ruangan = explode("+",Request()->ruangan)[0];
            $sesi = explode("+",Request()->ruangan)[1];
            $jenis_ruangan_id = Request()->jenis_ujian;
            $siswa = Siswa::all();
            $data = Absen::
            whereHas('siswa',function($query)use($id_ruangan,$sesi)
            {
                $query->where('id_ruangan',$id_ruangan);
                $query->Where('sesi',$sesi);
            })->whereDate('absen.created_at',date('Y-m-d'))->where('id_jenis',$jenis_ruangan_id);


            $all = $data->count();
            $all1 = $data->get();
            $nohadir = $data->where('status','!=','hadir')->get();
            $hadir = Absen::
            whereHas('siswa',function($query)use($id_ruangan,$sesi)
            {
                $query->where('id_ruangan',$id_ruangan);
                $query->Where('sesi',$sesi);
            })->whereDate('absen.created_at',date('Y-m-d'))->where('id_jenis',$jenis_ruangan_id)->where('status','hadir')->count();

            $jenis_ujian = Jenis_Ujian::find($jenis_ruangan_id);


        if($all == 0){
            return redirect()->back()->with('error',"Data Yang Sesuai Tidak Ditemukan");
        }

        $jurusan = Jurusan::all();
        $guru =Guru::find(Request()->nama_guru);
        $mapel1 = mapel::find(Request()->mapel1);
        $mapel2 = mapel::find(Request()->mapel2);
        $waktu = waktu::find(Request()->waktu);
        $ruang = ruangan::find($id_ruangan);

        $pdf = Pdf::loadview('export.BeritaAcara',compact('ruang','guru','all','all1', 'hadir', 'mapel1', 'mapel2', 'waktu','nohadir','jenis_ujian'));
        $pdf->setPaper('A4','portrait');
        return $pdf->download($ruang->nama_ruangan . '_R_'.($ruang->no_ruangan). '_SESI_'.$all1[0]->sesi.  '.pdf');
    }

    public function printAbsen(Request $request)
    {
        // dd('s');
        $request->validate([
            'waktu'=>'required',
            'jenis_ujian'=>'required'
        ]);

        $siswa = DB::table('siswa')
            ->select('siswa.*', 'jurusan')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->get();

        $data = DB::table('absen')
            ->join('siswa', 'absen.id_siswa', 'siswa.id')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->join('tahun_ajaran', 'absen.id_ajaran', 'tahun_ajaran.id')
            ->join('jenis_ujian', 'absen.id_jenis', 'jenis_ujian.id')
            ->select('absen.*','nama_siswa', 'nisn', 'no_kelas', 'tingkatan', 'jurusan','sesi', 'tahun', 'jenis')
            // ->where('siswa.kelas', $request->kelas)
            // ->where('siswa.no_kelas', $request->no_kelas)
            // ->where('jurusan.jurusan', $request->jurusan)
            ->get();

        $jurusan = DB::table('jurusan')->get();
        $ruang = DB::table('ruangan')->get();
        $guru = DB::table('guru')->get();

        return Excel::download(new absenExport($request->waktu), 'PRESESNI_SISWA.xlsx');
    }

}
