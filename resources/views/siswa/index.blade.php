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
                    <a href="{{ Request()->url() }}/create" class="btn btn-success" style="color:white ;">Tambah Data</a>
                    <button class="btn btn-primary" id="modal-siswa">Import</button>
                </div>


                <form action="/operator" method="get">
                    <input type="text" value="{{ $cari }}" name="cari" placeholder="Cari..."
                        class="form-control " autofocus id="">
                </form>
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
            <div class="card-body">
                <div class="card">
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
                                        <td> {{ $j->nama }} </td>
                                        <td> {{ $j->nisn }} </td>
                                        <td> {{ $j->tingkatan }} {{ $j->jurusan->jurusan }} {{ $j->no_kelas }} </td>
                                        <td> {{ $j->sesi }} </td>
                                        <td> {{ $j->ruangan->nama_ruangan }} </td>
                                        <td>
                                            <div class=" d-flex ">
                                                <div class="m-1">
                                                    <a href="{{ Request()->url() }}/{{ $j->id }}/edit"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="m-1">
                                                    <form class="d-inline"
                                                        action="{{ Request()->url() }}/{{ $j->id }}"
                                                        method="POST">
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
            <div class="card-footer text-right">
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection