@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Tambah Data Ruangan</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/ruangan" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Ruangan </label>
                            <input type="text" name="nama_ruangan" value="{{ old('nama_ruangan') }}" placeholder="Ruangan"
                                class="form-control">
                            @error('nama_ruangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Nama Teknisi</label>
                            <input type="text" name="nama_teknisi" value="{{ old('nama_teknisi') }}"
                                placeholder="Nama Teknisi" class="form-control">
                            @error('nama_teknisi')
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
