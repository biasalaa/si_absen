<?php

namespace App\Http\Controllers;

use App\Imports\RuanganImport;
use App\Models\Ruangan;
use App\Models\Tahun_Ajaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Str;
class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cari = Request()->cari;
        $data = Ruangan::paginate(20);
        if ($cari) {
        $data = Ruangan::where('nama_ruangan','like',"%$cari%")->paginate(20);
        }
        return view('ruangan.index', compact('data','cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('ruangan.create');
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
                'nama_ruangan'=>'required',
                'nama_teknisi'=>'required'
            ,],
            [
                'nama_ruangan.required'=>'Nama Ruangan Wajib Diisi',
                'nama_teknisi.required'=>'Nama Teknisi Wajib Diisi',
            ]
        );

        $ruangan = Str::upper(Request()->nama_ruangan);
        $nama_teknisi = Str::upper(Request()->nama_teknisi);
        $no_ruangan = Ruangan::count()+1;
        // insert data to database
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

        Ruangan::create([
            'nama_ruangan'=>$ruangan,
            'nama_teknisi'=>$nama_teknisi,
            'no_ruangan'=>$no_ruangan,
            'id_ajaran'=>$id_ajaran,
        ]);


        return redirect('/ruangan')->with('success','Berhasil Menambah Ruangan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruangan  $Ruangan
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $Ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruangan  $Ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruangan $Ruangan)
    {

        $data = $Ruangan;
        return view('ruangan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruangan  $Ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruangan $Ruangan)
    {
         Request()->validate(
            [
                'nama_ruangan'=>'required',
                'nama_teknisi'=>'required',
            ],['nama_ruangan.required'=>'Nama Ruangan Wajib Diisi',
                'nama_teknisi.required'=>'Nama Teknisi Wajib Diisi',
            ]
        );
        $RuanganData = Str::upper(Request()->nama_ruangan);
         $nama_teknisi = Str::upper(Request()->nama_teknisi);
        // update data to database
        $Ruangan->update([
            'nama_ruangan'=>$RuanganData,
            'nama_teknisi'=>$nama_teknisi,
        ]);

        return redirect('/ruangan')->with('success','Berhasil Mengedit Ruangan');
    }


     public function Import()
    {
         Request()->validate([
            'file' => 'required|mimes:xls,xlsx',
        ], [
            'file.required' => 'Harap di isi',
            'file.mimes' => 'Tidak support',
        ]);

        $file = Request()->file('file');
        $nama_file = Rand(1, 30) . $file->getClientOriginalName();
        $file->move(public_path('Excel'), $nama_file);

        $Ruangan = new RuanganImport;
        Excel::import($Ruangan, public_path('Excel/' . $nama_file));
        if ($Ruangan->error()) {
            return redirect()->back()->with('error', $Ruangan->pesan());
        }

        return redirect()->back()->with('success', $Ruangan->berhasil());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruangan  $Ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $Ruangan)
    {
        $Ruangan->delete();
        return redirect()->back()->with('success', 'Ruangan Berhasil Dihapus');
    }
}
