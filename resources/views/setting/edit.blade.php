@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Edit Data Setting</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/setting/{{ $setting->id }}" method="POST">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Judul</label>
                            <input type="text" value="{{ old('judul', $setting->judul) }}" name="judul"
                                class="form-control">
                            @error('judul')
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
