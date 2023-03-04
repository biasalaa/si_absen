@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Tambah Data Mapel</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/mapel" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Mapel</label>
                            <input type="text" name="nama_mapel" value="{{ old('nama_mapel') }}" placeholder="Nama Mapel"
                                class="form-control">
                            @error('nama_mapel')
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
