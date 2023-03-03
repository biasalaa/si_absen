<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Str;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
         $cari = Request()->cari;
        $data = User::where('role','operator')->paginate(20);
        if ($cari) {
        $data = User::where('nama','like','%'.$cari)->where('role','operator')->paginate(20);
        }
        return view('operator.index', compact('data','cari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('operator.create');
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
                'nama'=>'required',
                'username'=>'required|unique:users,username',
                'password'=>'required|min:8'
            ,],
            [
                'nama.required'=>'Nama Wajib Diisi',
                'username.required'=>'Username Wajib Diisi',
                'password.required'=>'Password Wajib Diisi',
            ]
        );
        $nama = Str::upper(Request()->nama);
        $username = Request()->username;
        $password = bcrypt(Request()->password);
        

        // insert data to database
        User::create([
            'nama'=>$nama,
            'username'=>$username,
            'password'=>$password,
            'role'=>'operator',
        ]);


        return redirect('/operator')->with('success','Berhasil Menambah Operator');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        
        $data = User::find($id);
        return view('operator.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      Request()->validate(
            [
                'nama'=>'required',
                'username'=>'required|unique:users,username,'.$id
            ,],
            [
                'nama.required'=>'Nama Wajib Diisi',
                'username.required'=>'Username Wajib Diisi',
                'password.required'=>'Password Wajib Diisi',
            ]
        );

        $nama = Str::upper(Request()->nama);
        $username = Request()->username;
        $password = bcrypt(Request()->password);

        $User = User::find($id);

        // insert data to database
        $User->update([
            'nama'=>$nama,
            'username'=>$username,
            'password'=>$password,
            'role'=>'operator',
        ]);


        return redirect('/operator')->with('success','Berhasil Mengubah Operator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        $User->delete();
        return redirect()->back()->with('success', 'Operator Berhasil Dihapus');
    }
}
