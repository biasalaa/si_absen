@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Tambah Data Siswa</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <form action="/siswa" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nama</label>
                            <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" placeholder="Nama Siswa"
                                class="form-control">
                            @error('nama_siswa')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label>NISN</label>
                            <input type="number" name="nisn" value="{{ old('nisn') }}" placeholder="NISN"
                                class="form-control">
                            @error('nisn')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Jurusan</label>
                            <select name="id_jurusan" class="form-control" id="">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $j)
                                    <option {{ old('id_jurusan') == $j->id ? 'checked' : '' }} value="{{ $j->id }}">
                                        {{ $j->jurusan }}</option>
                                @endforeach
                            </select>
                            @error('id_jurusan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Ruangan</label>
                            <select name="id_ruangan" class="form-control" id="">
                                <option value="">Pilih Ruangan</option>
                                @foreach ($ruangan as $j)
                                    <option {{ old('id_ruangan') == $j ? 'checked' : '' }} value="{{ $j->id }}">
                                        {{ $j->nama_ruangan }}</option>
                                @endforeach
                            </select>
                            @error('id_ruangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Sesi</label>
                            <div class="">
                                <label class="d-inline-flex mr-2"> <input value="1"
                                        {{ old('sesi') == 1 ? 'checked' : '' }} type="radio" class=""
                                        name="sesi" id="">
                                    1</label>
                                <label class="d-inline-flex mr-2"> <input value="2"
                                        {{ old('sesi') == 2 ? 'checked' : '' }} type="radio" class=""
                                        name="sesi" id="">
                                    2</label>
                                <label class="d-inline-flex mr-2"> <input value="3"
                                        {{ old('sesi') == 3 ? 'checked' : '' }} type="radio" class=""
                                        name="sesi" id="">
                                    3</label>
                                <label class="d-inline-flex mr-2"> <input value="4"
                                        {{ old('sesi') == 4 ? 'checked' : '' }} type="radio" class=""
                                        name="sesi" id="">
                                    4</label>
                                <label class="d-inline-flex mr-2"> <input value="5"
                                        {{ old('sesi') == 5 ? 'checked' : '' }} type="radio" class=""
                                        name="sesi" id="">
                                    5</label>
                            </div>
                            @error('sesi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Tingkatan</label>
                            <div class="">
                                <label class="d-inline-flex mr-2"> <input value='X'
                                        {{ old('tingkatan') == 'X' ? 'checked' : '' }} type="radio" class=""
                                        name="tingkatan" id="">
                                    X</label>
                                <label class="d-inline-flex mr-2"> <input value='XI'
                                        {{ old('tingkatan') == 'XI' ? 'checked' : '' }} type="radio" class=""
                                        name="tingkatan" id="">
                                    XI</label>
                                <label class="d-inline-flex mr-2"> <input value='XII'
                                        {{ old('tingkatan') == 'XII' ? 'checked' : '' }} type="radio" class=""
                                        name="tingkatan" id="">
                                    XII</label>
                                <label class="d-inline-flex mr-2"> <input value='V'
                                        {{ old('tingkatan') == 'V' ? 'checked' : '' }} type="radio" class=""
                                        name="tingkatan" id="">
                                    V</label>
                                <label class="d-inline-flex mr-2"> <input value='VI'
                                        {{ old('tingkatan') == 'VI' ? 'checked' : '' }} type="radio" class=""
                                        name="tingkatan" id="">
                                    VI</label>
                            </div>
                            @error('tingkatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-3">
                            <label>No Kelas</label>
                            <div class="">
                                <label class="d-inline-flex mr-2"> <input value="1"
                                        {{ old('no_kelas') == 1 ? 'checked' : '' }} type="radio" class=""
                                        name="no_kelas" id="">
                                    1</label>
                                <label class="d-inline-flex mr-2"> <input value="2"
                                        {{ old('no_kelas') == 2 ? 'checked' : '' }} type="radio" class=""
                                        name="no_kelas" id="">
                                    2</label>
                                <label class="d-inline-flex mr-2"> <input value="3"
                                        {{ old('no_kelas') == 3 ? 'checked' : '' }} type="radio" class=""
                                        name="no_kelas" id="">
                                    3</label>
                                <label class="d-inline-flex mr-2"> <input value="4"
                                        {{ old('no_kelas') == 4 ? 'checked' : '' }} type="radio" class=""
                                        name="no_kelas" id="">
                                    4</label>
                                <label class="d-inline-flex mr-2"> <input value="5"
                                        {{ old('no_kelas') == 5 ? 'checked' : '' }} type="radio" class=""
                                        name="no_kelas" id="">
                                    5</label>
                            </div>
                            @error('no_kelas')
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
