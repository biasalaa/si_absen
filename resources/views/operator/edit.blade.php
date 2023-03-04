@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Edit Data Operator</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/operator/{{ $data->id }}" method="POST">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nama</label>
                            <input type="text" name="nama" value="{{ old('nama', $data->nama) }}"
                                placeholder="Nama Operator" class="form-control">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Username</label>
                            <input type="text" name="username" value="{{ old('username', $data->username) }}"
                                placeholder="Username" class="form-control">
                            @error('username')
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
