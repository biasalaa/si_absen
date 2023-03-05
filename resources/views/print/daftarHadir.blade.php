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
                    <div class="row">
                        <div class="col-lg-5">
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

                        {{-- <a href="/print"><button type="button" class="btn btn-md col-lg-2 indigo" name="action" value="Print">print</button></a> --}}
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary" name="action" value="Print">print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
