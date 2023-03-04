@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Siapkan Ruangan</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible show fade m-2">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {!! session('success') !!}
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible show fade m-2">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {!! session('error') !!}
                    </div>
                </div>
            @endif
            <div class="card-body">
                <form action="/absenRuang" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col s3">
                            <div class="form-group">
                                <label>Ruangan</label>
                                <select class="form-control" name="ruangan">
                                    <option value="">Pilih Disini</option>
                                    @foreach ($ruangan as $r)
                                        <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ruangan')
                                <small style="color:red;">ruangan belum dipilih</small>
                            @enderror
                        </div>
                        <div class="col s3">
                            <div class="form-group">
                                <label>Sesi</label>
                                <select class="form-control" name="sesi">
                                    <option value="">Pilih Disini</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            @error('sesi')
                                <small style="color:red;">sesi belum dipilih</small>
                            @enderror
                        </div>



                        <div class="col s1 m-t-30">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="action" value="Siapkan Ruangan">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
