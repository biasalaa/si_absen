<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;

use App\Models\Jurusan;

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
        $jurusan = Jurusan::paginate(20);
        if ($cari) {
        $jurusan = Jurusan::where('jurusan','like','%'.$cari)->paginate(20);
        }
        return view('jurusan.index', compact('jurusan','cari'));
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
        DB::table('jurusan')->insert([
            'jurusan'=>$jurusan,
        ]);


        return redirect('/jurusan')->with('success','Berhasil Menambah Jurusan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jurusan = DB::table('jurusan')->where('id', $id)->first();
        return view('jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd('s');
        Request()->validate(
            [
                'jurusan'=>'required',
            ]
        );

        $jurusan = Str::upper(Request()->jurusan);

        // update data to database
        DB::table('jurusan')->where('id',$id)->update([
            'jurusan'=>$jurusan,
        ]);

        return redirect('/jurusan')->with('success','Berhasil Mengedit Jurusan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('jurusan')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'jurusan berhasil di hapus');
    }
}
