<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;

        }

        section {
            margin: auto;

        }

        h1,
        h2,
        h3,
        p {
            margin: 0
        }

        p {
            font-size: 11px
        }

        .header {
            display: flex;
            text-align: center;
            margin: auto;
            position: relative;
            align-items: center;
            justify-content: center;
        }


        .header .text {
            width: 70%;
        }

        .content {
            margin-top: 1rem;
            width: 70%;
            margin: 0 auto;
        }

        .content p {
            margin-bottom: 7px;
        }
    </style>
</head>

<body>

    @php
        $dayList = [
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
        ];
        $montList = [
            'Jan' => 'januari',
            'Feb' => 'Februari',
            'Mar' => 'Maret',
            'Apr' => 'April',
            'May' => 'Mei',
            'Jun' => 'Juni',
            'Jul' => 'Juli',
            'Aug' => 'Agustus',
            'Sep' => 'September',
            'Oct' => 'Oktober',
            'Nov' => 'November',
            'Dec' => 'Desember',
        ];
    @endphp
    <section>
        <div class="header">
            <div class="img" style="display: inline-block">
                <img src="https://seeklogo.com/images/J/jawa-timur-logo-24818906D1-seeklogo.com.png" width="80px">
            </div>

            <div class="text" style="display: inline-block">
                <h5 style="margin:0;font-weight:500">PEMERINTAH PROVINSI JAWA TIMUR<br>
                    DINAS PENDIDIKAN</h5>
                <h4 style="margin:0;margin-top:-2px">SEKOLAH MENENGAH KEJURUAN NEGERI 1 <br>
                    BONDOWOSO
                </h4>
                <p style="margin-top:-2px">Jalan HOS. Cokroaminoto No.110 / (0332) 431201 E-mail : smkn1_bws@yahoo.com
                </p>

            </div>
        </div>
        <hr style="margin-top:-10px">
        <div class="body">
            <h5 style="text-align: center;  padding-left: 75px;">BERITA ACARA <br>
                PENYELENGGARAAN UJIAN SATUAN PENDIDIKAN BERBASIS KOMPUTER <br>
                TAHUN PELAJARAN 2022/2023
            </h5>
            <div class="content">
                <p>Pada hari ini {{ $dayList[date('D')] }}, pada tanggal {{ date('d') }} bulan
                    {{ $montList[date('M')] }} tahun {{ date('Y') }}.</p>
                {{-- <p>Pada hari ini Jum'at, pada tanggal 02 bulan {{$montList[date('M')]}} tahun {{date('Y')}}.</p> --}}
                <p>Telah diselenggarakan UJIAN SATUAN PENDIDIKAN BERBASIS KOMPUTER (USPBK) dari pukul
                    {{ $waktu->waktu_awal }} s/d pukul {{ $waktu->waktu_akhir }}
                </p>
                <br>
                <p>Di sekolah : SMK NEGERI 1 BONDOWOSO </p>
                <p>Alamat : Jalan HOS. Cokroaminoto No.110 Bondowoso</p>
                <p>Ruang : {{ $ruang->nama_ruangan }} </p>
                <p>Mata Ujian : {{ $mapel1->nama_mapel }} {{ $mapel2 ? ' - ' . $mapel2->nama_mapel : '' }}</p>
                <p>Jumlah Peserta : {{ $all }} Orang</p>
                <p>Seharusnya : {{ $all }} Orang</p>
                <p>Yang Hadir : {{ $hadir }} Orang</p>
                <p>Yang Tidak Hadir : {{ $all - $hadir }} Orang, yakni : <br><br>
                    @foreach ($nohadir as $nohad)
                        {{ $nohadir ? $nohad->siswa->nama_siswa . ',' : '' }}
                    @endforeach
                    <br><br>


                <p> ⦁ Catatan selama pelaksanaan UJIAN SATUAN PENDIDIKAN BERBASIS KOMPUTER (USPBK). <br><br>
                    ………………………………………………………………………………………………………………… <br><br>
                    ………………………………………………………………………………………………………………… <br><br>
                    ………………………………………………………………………………………………………………… <br><br>
                </p>
                <p>Berita acara ini dibuat dengan sesungguhnya.</p> <br>

                <p>Yang membuat berita acara</p><br>

                <div style="justify-content:space-between ; ">
                    <div class="tanda" style="text-align: center; float:left ;">
                        <p> Pengawas,</p>
                        <br>
                        <div style="margin:0;margin-left:42px;">
                            <?php echo DNS2D::getBarcodeHTML('TELAH DITANDATANGANI OLEH ' . $guru->nama_guru, 'QRCODE', 3, 3); ?>
                        </div>
                        <br>
                        <br>
                        <p style="margin:0,margin-bottom:-20px; margin-left:18px;">{{ $guru->nama_guru }}</p>
                    </div>
                    <br>
                    <div class="tanda"
                        style="text-align: center;float:right; margin-left:20px; padding-left:20px ; margin-top:-18px;">
                        <p> Teknisi,</p><br>
                        <div style="margin:0;">
                            <?php echo DNS2D::getBarcodeHTML('TELAH DITANDATANGANI OLEH ' . $ruang->teknisi . '      ', 'QRCODE', 3, 3); ?>
                        </div>
                        <br>
                        <br>
                        <p style="margin:0">{{ $ruang->nama_teknisi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
