<?php

namespace App\Http\Controllers;

use App\Imports\MapelImport;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
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

        $mapel = new MapelImport;
        Excel::import($mapel, public_path('Excel/' . $nama_file));
        File::delete(public_path('Excel/' . $nama_file));
        if ($mapel->error()) {
            return redirect()->back()->with('error', $mapel->pesan());
        }

        return redirect()->back()->with('success', $mapel->berhasil());
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
