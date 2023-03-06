@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Print Daftar Hadir</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="/exportAbsen" method="POST">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Pilih Tanggal</label>
                                <input type="date" class="form-control" name="waktu">
                                @error('waktu')
                                    <small style="color:red">
                                        Silahkan memilih tanggal terlebih dahulu
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Pilih Jenis Ujian</label>
                                <select name="jenis_ujian" class="form-control" id="">
                                    <option value="">Pilih Disini</option>
                                    @foreach ($jenis_ujian as $j)
                                        <option value="{{ $j->id }}">{{ $j->jenis }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_ujian')
                                    <small style="color:red">
                                        Silahkan memilih jenis ujian terlebih dahulu
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary" name="action" value="Print">print</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
