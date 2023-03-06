<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Ujian;
use Illuminate\Http\Request;
use Str;


class JenisUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = Request()->cari;
        $data = Jenis_Ujian::paginate(20);
        if ($cari) {
            $data = Jenis_Ujian::where('jenis', 'like', '%' . $cari)->paginate(20);
        }
        return view('jenis_ujian.index', compact('data', 'cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis_ujian.create');
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
                'jenis' => 'required',
            ],
            [
                'Nama Jenis UJian Tidak Boleh kosong'
            ]
        );

        $jenis = (Request()->jenis);

        // insert data to database
        Jenis_Ujian::create([
            'jenis' => $jenis,
        ]);


        return redirect('/jenis-ujian')->with('success', 'Berhasil Menambah Jenis Ujian');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jenis_Ujian  $jenis_Ujian
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis_Ujian $jenis_Ujian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenis_Ujian  $jenis_Ujian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis_Ujian = Jenis_Ujian::find($id);
        return view('jenis_ujian.edit', compact('jenis_Ujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jenis_Ujian  $jenis_Ujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jenis_Ujian $jenis_Ujian)
    {
        // dd('s');
        Request()->validate(
            [
                'jenis' => 'required',
            ],
            [
                'Nama Jenis UJian Tidak Boleh kosong'
            ]
        );

        $jenis = (Request()->jenis);

        // insert data to database
        $jenis_Ujian->update([
            'jenis' => $jenis,
        ]);


        return redirect('/jenis-ujian')->with('success', 'Berhasil Mengedit jenis ujian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jenis_Ujian  $jenis_Ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis_Ujian = Jenis_Ujian::find($id)->delete();
        return redirect()->back()->with('success', 'jenis ujian Berhasil Di Hapus');
    }
}
