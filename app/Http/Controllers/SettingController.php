<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $cari = Request()->cari;
        $data = Setting::paginate(20);
        if ($cari) {
        $data = Setting::where('judul','like','%'.$cari)->paginate(20);
        }
        return view('setting.index',compact('cari', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.create');
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
                'judul'=>'required',
            ]
        );

        $Setting = (Request()->judul);

        // insert data to database
        Setting::create([
            'judul'=>$Setting,
        ]);


        return redirect('/setting')->with('success','Berhasil Menambah Judul');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $Setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $Setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $Setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $Setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $Setting)
    {
          Request()->validate(
            [
                'judul'=>'required',
            ]
        );

        $SettingData = (Request()->judul);

        // insert data to database
        $Setting->update([
            'judul'=>$SettingData,
        ]);


        return redirect('/setting')->with('success','Berhasil Mengedit Setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $Setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $Setting)
    {
        $Setting->delete();
        return redirect()->back()->with('success', 'Setting Berhasil Di Hapus');
    }
}
