<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Ruangan;
use App\Models\Siswa;
use App\Models\Tahun_Ajaran;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cari = Request()->cari;
        $data = Siswa::paginate(20);
        if ($cari) {
        $data = Siswa::where('nama_siswa','like','%'.$cari)->paginate(20);
        }
        return view('siswa.index', compact('data','cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $ruangan = Ruangan::all();
         return view('siswa.create',compact('jurusan','ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Request()->validate(
            [
                'nama_siswa'=>'required',
                'nisn'=>'required|numeric',
                'id_jurusan'=>'required',
                'id_ruangan'=>'required',
                'sesi'=>'required',
                'no_kelas'=>'required',
                'tingkatan'=>'required',
            ],
            [
                'nama_siswa.required'=>'Nama Wajib Diisi',
                'nisn.required'=>'Nisn Wajib Diisi',
                'id_jurusan.required'=>'Jurusan Wajib Diisi',
                'id_ruangan.required'=>'Ruangan Wajib Diisi',
                'sesi.required'=>'Sesi Wajib Diisi',
                'no_kelas.required'=>'Nomor Kelas Wajib Diisi',
                'tingkatan.required'=>'Tingkatan Kelas Wajib Diisi',
            ]
        );

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

        Request()['id_ajaran'] =  $id_ajaran;


        // insert data to database
        Siswa::create(Request()->all());


        return redirect('/siswa')->with('success','Berhasil Menambah Siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
         $jurusan = Jurusan::all();
        $ruangan = Ruangan::all();
        $data = Siswa::find($id);
        return view('siswa.edit', compact('data','jurusan','ruangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      Request()->validate(
            [
                'nama_siswa'=>'required',
                'nisn'=>'required|numeric',
                'id_jurusan'=>'required',
                'id_ruangan'=>'required',
                'sesi'=>'required',
                'no_kelas'=>'required',
                'tingkatan'=>'required',
            ],
            [
                'nama_siswa.required'=>'Nama Wajib Diisi',
                'nisn.required'=>'Nisn Wajib Diisi',
                'id_jurusan.required'=>'Jurusan Wajib Diisi',
                'id_ruangan.required'=>'Ruangan Wajib Diisi',
                'sesi.required'=>'Sesi Wajib Diisi',
                'no_kelas.required'=>'Nomor Kelas Wajib Diisi',
                'tingkatan.required'=>'Tingkatan Kelas Wajib Diisi',
            ]
        );

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

        Request()['id_ajaran'] =  $id_ajaran;


        // insert data to database
        Siswa::find($id)->update(Request()->all());


        return redirect('/siswa')->with('success','Berhasil Mengubah Siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        $User->delete();
        return redirect()->back()->with('success', 'Siswa Berhasil Dihapus');
    }
}
