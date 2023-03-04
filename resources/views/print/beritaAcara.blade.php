@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Print Berita Acara</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="/print-berita" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Ruangan</label>
                                <select class="form-control    js-select" name="ruangan">
                                    <option value="">Pilih Disini</option>
                                    @foreach ($ruangan as $r)
                                        <option {{ old('ruangan') == $r->id ? 'selected' : '' }}
                                            value="{{ $r->id }}"> {{ $r->nama_ruangan }}</option Required>
                                    @endforeach
                                </select>
                                @error('ruangan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Pengawas Ujian</label>
                                <select class="form-control    js-select" name="nama_guru">
                                    <option value="">Pilih Disini</option>
                                    @foreach ($guru as $g)
                                        <option {{ old('nama_guru') == $g->id ? 'selected' : '' }}
                                            value="{{ $g->id }}">
                                            {{ $g->nama_guru }}</option Required>
                                    @endforeach
                                </select>
                                @error('guru')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>sesi</label>
                                <select class="form-control    js-select" name="sesi" Required>
                                    <option value="">pilih</option>
                                    <option {{ old('sesi') == 1 ? 'selected' : '' }} value="1">1</option>
                                    <option {{ old('sesi') == 2 ? 'selected' : '' }} value="2">2</option>
                                    <option {{ old('sesi') == 3 ? 'selected' : '' }} value="3">3</option>
                                </select>
                                @error('sesi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Waktu Ujian</label>
                                <select class="form-control    js-select" name="waktu">
                                    <option value="">Pilih Disini</option>
                                    @foreach ($waktu as $w)
                                        <option value="{{ $w->id }}"> {{ $w->waktu_awal }}
                                            {{ $w->waktu_akhir }}</option Required>
                                    @endforeach
                                </select>
                                @error('waktu')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Mapel 1 </label>
                                <select class="form-control    js-select" name="mapel1">
                                    <option value="">Pilih</option>
                                    @foreach ($mapel1 as $m)
                                        <option value="{{ $m->id }}"> {{ $m->nama_mapel }}</option Required>
                                    @endforeach
                                </select>
                                @error('mapel1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-5">

                            <div class="form-group">
                                <label>Mapel 2 (optional) </label>

                                <select class="form-control    js-select" name="mapel2">
                                    <option value="">Pilih</option>
                                    @foreach ($mapel2 as $m2)
                                        <option value="{{ $m2->id }}"> {{ $m2->nama_mapel }}</option>
                                    @endforeach
                                </select>
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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col s12">
                        <div class="card-content" style="text-align: center;">
                            <h5 class="card-title">Catatan</h5><br>
                            <p>Mapel 2 di isi apabila terdapat 2 mapel berbeda di jam yang sama, jika tidak ada tidak
                                perlu di
                                isi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
