@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Edit Data Jenis Ujian</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/jenis-ujian/{{ $jenis_Ujian->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Nama Jenis Ujian</label>
                            <input type="text" value="{{ old('jenis', $jenis_Ujian->jenis) }}" name="jenis"
                                class="form-control">
                            @error('jenis')
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
