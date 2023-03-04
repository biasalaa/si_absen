<?php

namespace App\Http\Controllers;

use App\Models\Waktu;
use Illuminate\Http\Request;

class WaktuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cari = Request()->cari;
        $data = Waktu::paginate(20);
        if ($cari) {
        $data = Waktu::where('waktu_awal','like','%'.$cari)->paginate(20);
        }
        return view('waktu.index',compact('cari', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('waktu.create');
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
                'waktu_awal'=>'required',
                'waktu_akhir'=>'required',
            ]
        );

        $waktu_awal = (Request()->waktu_awal);
        $waktu_akhir = (Request()->waktu_akhir);


        // insert data to database
        Waktu::create([
            'waktu_awal'=>$waktu_awal,
            'waktu_akhir'=>$waktu_akhir,
        ]);


        return redirect('/waktu')->with('success','Berhasil Menambah waktu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function show(Waktu $waktu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function edit(Waktu $waktu)
    {
         $data = $waktu;
        return view('waktu.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waktu $waktu)
    {
        Request()->validate(
            [
                'waktu_awal'=>'required',
                'waktu_akhir'=>'required',
            ],
            [
                'waktu_awal.required'=>'Waktu Awal Wajib Diisi',
                'waktu_akhir.required'=>'Waktu Akhir Wajib Diisi'
            ]
        );
        $waktu_awal = (Request()->waktu_awal);
        $waktu_akhir = (Request()->waktu_akhir);
        // update data to database
        $waktu->update([
            'waktu_awal'=>$waktu_awal,
            'waktu_akhir'=>$waktu_akhir,
        ]);

        return redirect('/waktu')->with('success','Berhasil Mengedit Waktu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waktu $waktu)
    {
        $waktu->delete();
        return redirect()->back()->with('success', 'Waktu Berhasil Dihapus');
    }
}
