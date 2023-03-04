@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Edit Data Guru</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/guru/{{ $data->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Nama Guru</label>
                            <input type="text" name="nama_guru" placeholder="nama guru" class="form-control"
                                value="{{ old('nama_guru', $data->nama_guru) }}">
                            @error('nama_guru')
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
