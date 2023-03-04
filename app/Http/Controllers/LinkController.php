<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cari = Request()->cari;
        $data = Link::paginate(20);
        if ($cari) {
        $data = Link::where('url','like','%'.$cari)->paginate(20);
        }
        return view('link.index',compact('cari', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('link.create');
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
                'link'=>'required',
            ]
        );

        $link = (Request()->link);

        // insert data to database
        Link::create([
            'url'=>$link,
        ]);


        return redirect('/link')->with('success','Berhasil Menambah link');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return view('link.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
          Request()->validate(
            [
                'link'=>'required',
            ]
        );

        $linkData = (Request()->link);

        // insert data to database
        $link->update([
            'url'=>$linkData,
        ]);


        return redirect('/link')->with('success','Berhasil Mengedit link');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->back()->with('success', 'Link Berhasil Di Hapus');
    }
}
