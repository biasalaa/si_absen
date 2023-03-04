<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Ruangan;
use App\Models\Siswa;
use App\Models\Tahun_Ajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        $siswa = DB::table('siswa')
            ->select('jurusan', 'siswa.*', 'nama_ruangan')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->join('ruangan', 'siswa.id_ruangan', 'ruangan.id')
            ->simplePaginate(10);
        $jurusan = DB::table('jurusan')->get();
        $ruang = DB::table('ruangan')->get();
        $data = [];
        return view('absen.absensi', compact('siswa', 'jurusan', 'ruang','data'));
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
    public function create(Request $request)
    {
        // dd('s');
        $absen = Absen::all();
        $siswa = DB::table('siswa')
            ->select('siswa.*', 'jurusan')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->get();

        $data = DB::table('absen')
            ->rightJoin('siswa', 'absen.id_siswa', 'siswa.id')
            ->join('jurusan', 'siswa.id_jurusan', 'jurusan.id')
            ->join('ruangan', 'siswa.id_ruangan', 'ruangan.id')
            ->select('absen.*','nama_siswa', 'nisn', 'no_kelas', 'tingkatan', 'jurusan','siswa.id as id_siswa', 'sesi', 'nama_ruangan')
            ->where('ruangan.id',$request->ruangan)
            ->where('siswa.sesi',$request->sesi)
            ->whereDate('absen.created_at',$request->waktu)
            ->get();

        $jurusan = DB::table('jurusan')->get();
        $ruang = DB::table('ruangan')->get();


        // hadirkan semua
        if (Request()->has('hadirsemua')) {
            try {
            foreach ($data as $d ) {


            $ds = DB::table('absen')->where('id_siswa',$d->id_siswa)->update([
                "status" => 'hadir',
            ]);

            }
            return redirect()->back()->with('success','Berhasil menghadirkan siswa');
        } catch (\Throwable $th) {
            dd('error');
        }
        }



        return view('absen.absensi', compact('jurusan', 'data','ruang'));
    }

    public function upStatus(Request $request,$id){
        $request->validate(
            [
                'status' => 'required'
            ],
            [
                'status.required' => 'status wajib di isi'
            ]
        );

                DB::table('absen')->where('id_siswa',$id)->update([
                "status" => $request->status,
            ]);


        return redirect()->back()->with('success', 'status berhasil di edit');
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
