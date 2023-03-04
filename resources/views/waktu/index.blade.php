@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Waktu Ujian</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header" style="justify-content: space-between">
                <a href="/waktu/create" class="btn btn-success" style="color:white ;">Tambah Data</a>
                <form action="/waktu" method="get">
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
                        {{ session('success') }}
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
                                    <th scope="col">Waktu Awal</th>
                                    <th scope="col">Waktu Akhir</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                <tr>
                                    <?php $no = 1; ?>
                                    @forelse ($data as $w)
                                        <th scope="row">{{ $no++ }}</th>
                                        <td> {{ $w->waktu_awal }} </td>
                                        <td> {{ $w->waktu_akhir }} </td>
                                        <td>
                                            <div class=" d-flex ">
                                                <div class="m-1">
                                                    <a href="/waktu/{{ $w->id }}/edit" class="btn btn-warning"><i
                                                            class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="m-1">
                                                    <form class="d-inline" action="/waktu/{{ $w->id }}"
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
                                    <td colspan="3" align="center">Data Belum Ada</td>
                                </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                {{ $data->waktus() }}
            </div>
        </div>
    </div>
@endsection
