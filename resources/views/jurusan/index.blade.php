@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Jurusan</h1>
    </div>
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header" style="justify-content: space-between">
                <a href="/jurusan/create" class="btn btn-success" style="color:white ;">Tambah Data</a>
                <form action="/jurusan" method="get">
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
                                    <th scope="col">#</th>
                                    <th scope="col">Jurusan</th>
                                </tr>
                                <tr>
                                    <?php $no = 1; ?>
                                    @foreach ($jurusan as $j)
                                        <th scope="row">{{ $no++ }}</th>
                                        <td> {{ $j->jurusan }} </td>
                                        <td>
                                            <div class=" d-flex ">
                                                <div class="m-1">
                                                    <a href="/jurusan/{{ $j->id }}/edit" class="btn btn-warning"><i
                                                            class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="m-1">
                                                    <form class="d-inline" action="/jurusan/{{ $j->id }}"
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
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                {{ $jurusan->links() }}
            </div>
        </div>
    </div>
@endsection
