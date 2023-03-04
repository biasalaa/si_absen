<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Guru;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Str;
class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
         $cari = Request()->cari;
        $data = Guru::paginate(20);
        if ($cari) {
        $data = Guru::where('nama_guru','like','%'.$cari)->paginate(20);
        }
        return view('guru.index', compact('data','cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('guru.create');
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
                'nama_guru'=>'required'
            ,],['nama_guru.required'=>'Nama Guru Wajib Diisi']
        );

        $namaGuru = Str::upper(Request()->nama_guru);


        // insert data to database
        Guru::create([
            'nama_guru'=>$namaGuru,
        ]);


        return redirect('/guru')->with('success','Berhasil Menambah Guru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $Guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $Guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $Guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $Guru)
    {
        $data = $Guru;
        return view('guru.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $Guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $Guru)
    {
         Request()->validate(
            [
                'nama_guru'=>'required',
            ],['nama_guru.required'=>'Nama Guru Wajib Diisi']
        );
        $GuruData = Str::upper(Request()->nama_guru);
        // update data to database
        $Guru->update([
            'nama_guru'=>$GuruData,
        ]);

        return redirect('/guru')->with('success','Berhasil Mengedit Guru');
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

        Excel::import(new SiswaImport, public_path('Excel/' . $nama_file));

        return redirect()->back()->with('success', 'siswa berhasil diimport');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $Guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $Guru)
    {
        $Guru->delete();
        return redirect()->back()->with('success', 'Guru Berhasil Dihapus');
    }
}
