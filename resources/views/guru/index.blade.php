@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Guru</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header" style="justify-content: space-between">
                <div class="">
                    <a href="{{ Request()->url() }}/create" class="btn btn-success" style="color:white ;">Tambah Data</a>
                    <button class="btn btn-primary" id="modal-guru">Import</button>
                </div>

                <form action="/guru" method="get">
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
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                <tr>
                                    @forelse ($data as $j)
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td> {{ $j->nama_guru }} </td>
                                        <td>
                                            <div class=" d-flex ">
                                                <div class="m-1">
                                                    <a href="{{ Request()->url() }}/{{ $j->id }}/edit"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="m-1">
                                                    <form class="d-inline"
                                                        action="{{ Request()->url() }}/{{ $j->id }}" method="POST">
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
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
