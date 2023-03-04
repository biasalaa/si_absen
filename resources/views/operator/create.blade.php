@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Tambah Data Operator</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/operator" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nama</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Operator"
                                class="form-control">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username"
                                class="form-control">
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Password</label>
                            <input type="text" name="password" value="{{ old('password') }}" placeholder="Password"
                                class="form-control">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>



                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
