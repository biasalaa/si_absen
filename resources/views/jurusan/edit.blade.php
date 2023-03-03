@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Edit Data Jurusan</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/jurusan/{{ $jurusan->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" value="{{ $jurusan->jurusan }}">
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
