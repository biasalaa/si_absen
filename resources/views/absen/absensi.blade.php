@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Absensi Siswa</h1>
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
            <form action="/filter-absen" method="get">
                {{-- @csrf --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Ruangan</label>
                                <select class="form-control" name="ruangan">
                                    <option value="">Pilih Disini</option>
                                    @foreach ($ruang as $r)
                                        <option value="{{ $r->id }}"> {{ $r->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Sesi</label>
                                <select class="form-control" name="sesi">
                                    <option value="">Pilih Disini</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Pilih Waktu</label>
                                <input type="date" class="form-control" name="waktu">
                            </div>
                        </div>

                        <div class="col-lg-1 ">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="action" value="Filter">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (count($data) > 0)
        <div class="card">
            <div class="card-header" style="justify-content: space-between">
                <div class="">
                    <h5 class="card-title">Data Siswa</h5>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ url()->full() }}&hadirsemua" type="submit">Hadirkan
                        Semua</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table striped m-b-20" id="editable-datatable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nama</th>
                                    <th>Nisn</th>
                                    <th>Kelas</th>
                                    <th>Sesi</th>
                                    <th>Ruang</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $d->siswa->nama_siswa }}</td>
                                        <td>{{ $d->siswa->nisn }}</td>
                                        <td>{{ $d->siswa->tingkatan }} {{ $d->siswa->jurusan->jurusan }}
                                            {{ $d->siswa->no_kelas }}
                                        </td>
                                        <td>{{ $d->siswa->sesi }}</td>
                                        <td>{{ $d->siswa->ruangan->nama_ruangan }}</td>
                                        <td><b style="color: rebeccapurple;font-weight: 900">{{ $d->status }}</b>
                                        </td>


                                        <td class="">
                                            <button
                                                onclick="updateStatus({{ $d->id }},'{{ $d->siswa->nama_siswa }}','{{ $d->status }}')"
                                                class="btn btn-primary" id="modal-absen-{{ $d->id }}"><i
                                                    class="fas fa-pen"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
