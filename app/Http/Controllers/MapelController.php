<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Str;
class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cari = Request()->cari;
        $data = Mapel::paginate(20);
        if ($cari) {
        $data = Mapel::where('mapel','like','%'.$cari)->paginate(20);
        }
        return view('mapel.index', compact('data','cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('mapel.create');
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
                'nama_mapel'=>'required'
            ,],['nama_mapel.required'=>'Nama Mapel Wajib Diisi']
        );

        $Mapel = Str::upper(Request()->nama_mapel);


        // insert data to database
        Mapel::create([
            'nama_mapel'=>$Mapel,
        ]);


        return redirect('/mapel')->with('success','Berhasil Menambah Mapel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $Mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $Mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $Mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $Mapel)
    {

        $data = $Mapel;
        return view('mapel.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $Mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $Mapel)
    {
         Request()->validate(
            [
                'nama_mapel'=>'required',
            ],['nama_mapel.required'=>'Nama Mapel Wajib Diisi']
        );
        $MapelData = Str::upper(Request()->nama_mapel);
        // update data to database
        $Mapel->update([
            'nama_mapel'=>$MapelData,
        ]);

        return redirect('/mapel')->with('success','Berhasil Mengedit Mapel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $Mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $Mapel)
    {
        $Mapel->delete();
        return redirect()->back()->with('success', 'Mapel Berhasil Dihapus');
    }
}
