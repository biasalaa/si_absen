<?php

namespace App\Http\Controllers;

use App\Imports\JurusanImport;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Str;
class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cari = Request()->cari;
        $data = Jurusan::paginate(20);
        if ($cari) {
        $data = Jurusan::where('jurusan','like','%'.$cari)->paginate(20);
        }
        return view('jurusan.index', compact('data','cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('jurusan.create');
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
                'jurusan'=>'required',
            ]
        );

        $jurusan = Str::upper(Request()->jurusan);


        // insert data to database
        Jurusan::create([
            'jurusan'=>$jurusan,
        ]);


        return redirect('/jurusan')->with('success','Berhasil Menambah Jurusan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
         Request()->validate(
            [
                'jurusan'=>'required',
            ]
        );

        $jurusanData = Str::upper(Request()->jurusan);
        // update data to database
        $jurusan->update([
            'jurusan'=>$jurusanData,
        ]);

        return redirect('/jurusan')->with('success','Berhasil Mengedit Jurusan');
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

        $jurusan = new JurusanImport;
        Excel::import($jurusan, public_path('Excel/' . $nama_file));
        if ($jurusan->error()) {
            return redirect()->back()->with('error', $jurusan->pesan());
        }

        return redirect()->back()->with('success', $jurusan->berhasil());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->back()->with('success', 'jurusan berhasil di hapus');
    }
}
