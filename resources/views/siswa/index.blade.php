@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Siswa</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header" style="justify-content: space-between">
                <div class="">
                    <h3><b>FIlter </b></h3>
                </div>
                <div class="">
                    <button class="btn btn-primary" id="modal-siswa">Import Data Siswa</button>
                </div>
            </div>

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

            <form action="/filter-siswa" method="get">
                {{-- @csrf --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control " name="kelas">
                                    <option value="">Pilih Disini</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Sesi</label>
                                <select name="jurusan" class="form-control select2" id="">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($jurusan as $j)
                                        <option {{ old('id_jurusan') == $j->id ? 'checked' : '' }}
                                            value="{{ $j->id }}">
                                            {{ $j->jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>No Kelas</label>
                                <select class="form-control" name="no_kelas">
                                    <option value="">Pilih Disini</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1" style="margin-top:30px ;>
                            <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="action" value="Filter">
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>

    @if (count($cek) > 0)
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <a href="siswa/create" class="btn btn-success" style="color:white ;">Tambah Data
                        Siswa</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">NiSN</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Sesi</th>
                                <th scope="col">Ruangan</th>
                            </tr>
                            <tr>
                                @forelse ($data as $j)
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td> {{ $j->nama_siswa }} </td>
                                    <td> {{ $j->nisn }} </td>
                                    <td> {{ $j->tingkatan }} {{ $j->jurusan->jurusan }} {{ $j->no_kelas }} </td>
                                    <td> {{ $j->sesi }} </td>
                                    <td> {{ $j->ruangan->nama_ruangan }} </td>
                                    <td>
                                        <div class=" d-flex ">
                                            <div class="m-1">
                                                <a href="siswa/{{ $j->id }}/edit" class="btn btn-warning"><i
                                                        class="fas fa-edit"></i></a>
                                            </div>
                                            <div class="m-1">
                                                <form class="d-inline" action="siswa/{{ $j->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" align="center">Data Belum Ada</td>
                            </tr>
    @endforelse
    </table>
    </div>
    </div>
    </div>
    </div>
    @endif
@endsection
