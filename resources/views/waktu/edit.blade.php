@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Ubah Data Waktu</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/waktu/{{ $data->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Waktu Awal</label>
                            <input type="time" name="waktu_awal" value="{{ $data->waktu_awal }}" placeholder="Waktu Awal"
                                class="form-control">
                            @error('waktu_awal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Waktu Akhir</label>
                            <input type="time" name="waktu_akhir" value="{{ $data->waktu_akhir }}"
                                placeholder="Waktu Awal" class="form-control">
                            @error('waktu_akhir')
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
