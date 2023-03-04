@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>link</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header" style="justify-content: space-between">
                @if (!count($data))
                    <a href="/link/create" class="btn btn-success" style="color:white ;">Tambah Data</a>
                @endif
                <form action="/link" method="get">
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
                                    <th scope="col">Link</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                <tr>
                                    @forelse ($data as $l)
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td> {{ $l->url }} </td>
                                        <td>
                                            <div class=" d-flex ">
                                                <div class="m-1">
                                                    <a href="/link/{{ $l->id }}/edit" class="btn btn-warning"><i
                                                            class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="m-1">
                                                    <form class="d-inline" action="/link/{{ $l->id }}"
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
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
