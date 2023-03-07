@extends('component.master')

@section('header')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Siswa</h4>
                    </div>
                    <div class="card-body">
                        {{ $siswa_total }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Jurusan</h4>
                    </div>
                    <div class="card-body">
                        {{ $jurusan_total }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Ruangan</h4>
                    </div>
                    <div class="card-body">
                        {{ $ruangan_total }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Mapel</h4>
                    </div>
                    <div class="card-body">
                        {{ $mapel_total }}
                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Ruangan Yang Sudah Disiapkan</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>

                                <th>Ruangan</th>
                                <th>Total Siswa</th>
                                <th>Siswa Hadir</th>
                                <th>Siswa Tidak Hadir</th>
                            </tr>
                            @foreach ($info_ruangan as $ir)
                                <tr>


                                    <td class="align-middle">
                                        {{ $ir->nama_ruangan }}
                                    </td>
                                    <td>
                                        {{ $ir->total_siswa }}
                                    </td>
                                    <td>
                                        {{ $ir->total_siswa_hadir }}
                                    </td>
                                    <td>
                                        {{ $ir->total_siswa_tidak_hadir }}
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h6>Ruangan Yang Belum Disiapkan</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height:500px ;overflow: auto">
                        <table class="table table-striped">
                            @foreach ($ruangan_belum_disiapkan as $ir)
                                <tr>
                                    <td class="align-middle">
                                        {{ $ir->nama_ruangan }}
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
=======

    <div class="row">
        <div class="card">
            .
>>>>>>> 8209901d4412d0279b40790bb243831f7d070408
        </div>
    </div>
@endsection
