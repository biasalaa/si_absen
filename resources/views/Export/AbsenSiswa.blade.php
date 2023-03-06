<table>
    @foreach ($ruang as $r)
        @php
            $index = 1;
        @endphp
        @foreach ($data as $row)
            @if ($r->id == $row->siswa->id_ruangan && $index == 1)
                <tr colspan="6">
                <tr colspan="6">
                <tr colspan="6">
                    <th align="center" colspan="6" style="font-size: 15px;font-weight: bold; width:800px">
                        {{ 'RUANG' }}
                        {{ $r->no_ruangan }} ( {{ $r->nama_ruangan }} )</th>
                <tr colspan="6">
                    <th align="center" colspan="6" style="font-size: 15px;font-weight: bold; width:800px">
                        {{ $jenis_ujian->jenis }}</th>

                <tr colspan="6">
                    <th align="center" colspan="6" style="font-size: 15px;font-weight: bold; width:800px">TAHUN
                        PELAJARAN
                        {{ $data[0]->tahun_ajaran->tahun }}</th>
                </tr>
                @php
                    $index++;
                @endphp
            @endif
        @endforeach

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
            $day = date('D');
        @endphp


        @php
            $nomer1 = 1;
            $index1 = 1;
        @endphp

        @foreach ($data as $row)
            @if ($row->siswa->sesi == 1 && $r->id == $row->siswa->id_ruangan)
                @if ($index1 == 1)
                    <tr>
                        <td colspan="6" align="right">
                            {{ $dayList[$day] . ' , ' . date('d-') . $montList[date('M')] . date('-Y') }}
                        </td>
                        {{-- <td colspan="6" align="right">{{ 'Jumat'.' , '. '02-'.$montList[date('M')] .date('-Y') }}</td> --}}
                    <tr style="background-color: #DC3535;border:1px solid #000" colspan="6">
                        <td style="background-color: #F49D1A;border:1px solid #000" colspan="6" align="center">SESI 1
                        </td>

                    </tr>
                    <tr>
                        <td style="background-color: #F49D1A;border:1px solid #000;width:50px">#</td>
                        <td style="background-color: #F49D1A;border:1px solid #000;width:100px" align="left">NISN</td>
                        <td style="background-color: #F49D1A;border:1px solid #000;width:350px">NAMA</td>
                        <td style="background-color: #F49D1A;border:1px solid #000;width:400px">KELAS</td>
                        <td style="background-color: #F49D1A;border:1px solid #000;width:100px">STATUS</td>

                        <td style="background-color: #F49D1A;border:1px solid #000;width:100px">SESI</td>
                    </tr>
                    @php
                        $index1++;
                    @endphp
                @endif
                <tr>
                    <td style="border:1px solid #000">{{ $nomer1++ }}</td>
                    <td style="border:1px solid #000">{{ Str::upper($row->siswa->nisn) }}</td>
                    <td style="border:1px solid #000">{{ Str::upper($row->siswa->nama_siswa) }}</td>
                    <td style="border:1px solid #000">
                        {{ Str::upper($row->siswa->tingkatan . ' ' . $row->siswa->jurusan->jurusan . ' ' . $row->siswa->no_kelas) }}
                    </td>
                    <td style="border:1px solid #000">{{ Str::upper($row->status) }}</td>

                    <td style="border:1px solid #000">{{ $row->siswa->sesi }}</td>
                </tr>
            @endif
        @endforeach



        @php
            $nomer2 = 1;
            $index2 = 1;
        @endphp
        @foreach ($data as $row)
            @if ($row->siswa->sesi == 2 && $r->id == $row->siswa->id_ruangan)
                @if ($index2 == 1)
                    <tr colspan="6"></tr>
                    <tr colspan="6"></tr>

                    <tr>
                        <td colspan="6" align="right">{{ $dayList[$day] . ' , ' . date('d-M-Y') }}</td>
                    <tr style="background-color: #DC3535;border:1px solid #000" colspan="6">
                        <td style="background-color: #5F8D4E;border:1px solid #000" colspan="6" align="center">SESI 2
                        </td>

                    </tr>
                    <tr>
                        <td style="background-color: #5F8D4E;border:1px solid #000;width:50px">#</td>
                        <td style="background-color: #5F8D4E;border:1px solid #000;width:100px" align="left">NISN</td>
                        <td style="background-color: #5F8D4E;border:1px solid #000;width:350px">NAMA</td>
                        <td style="background-color: #5F8D4E;border:1px solid #000;width:400px">KELAS</td>
                        <td style="background-color: #5F8D4E;border:1px solid #000;width:100px">STATUS</td>

                        <td style="background-color: #5F8D4E;border:1px solid #000;width:100px">SESI</td>
                    </tr>
                    @php
                        $index2++;
                    @endphp
                @endif
                @foreach ($jurusan as $j)
                    @if ($j->id == $row->siswa->id_jurusan)
                        <tr>
                            <td style="border:1px solid #000">{{ $nomer2++ }}</td>
                            <td style="border:1px solid #000">{{ Str::upper($row->siswa->nisn) }}</td>
                            <td style="border:1px solid #000">{{ Str::upper($row->siswa->nama_siswa) }}</td>
                            <td style="border:1px solid #000">
                                {{ Str::upper($row->siswa->tingkatan . ' ' . $row->siswa->jurusan->jurusan . ' ' . $row->siswa->no_kelas) }}
                            </td>
                            <td style="border:1px solid #000">{{ Str::upper($row->status) }}</td>

                            <td style="border:1px solid #000">{{ $row->siswa->sesi }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        @endforeach


        @php
            $nomer3 = 1;
        @endphp
        @foreach ($data as $row)
            @if ($row->siswa->sesi == 3 && $r->id == $row->siswa->id_ruangan)
                @if ($index3 == 1)
                    <tr colspan="6"></tr>
                    <tr colspan="6"></tr>

                    <tr>
                        <td colspan="6" align="right">{{ $dayList[$day] . ' , ' . date('d-M-Y') }}</td>
                    <tr style="background-color: #DC3535;border:1px solid #000" colspan="6">
                        <td style="background-color: #DC3535;border:1px solid #000" colspan="6" align="center">SESI 3
                        </td>


                    </tr>
                    <tr>
                        <td style="background-color: #DC3535;border:1px solid #000;width:50px">#</td>
                        <td style="background-color: #DC3535;border:1px solid #000;width:100px" align="left">NISN</td>
                        <td style="background-color: #DC3535;border:1px solid #000;width:350px">NAMA</td>
                        <td style="background-color: #DC3535;border:1px solid #000;width:400px">KELAS</td>
                        <td style="background-color: #DC3535;border:1px solid #000;width:100px">STATUS</td>

                        <td style="background-color: #DC3535;border:1px solid #000;width:100px">SESI</td>
                    </tr>
                    @php
                        $index3++;
                    @endphp
                @endif
                <tr>
                    <td style="border:1px solid #000">{{ $nomer3++ }}</td>
                    <td style="border:1px solid #000">{{ Str::upper($row->siswa->nisn) }}</td>
                    <td style="border:1px solid #000">{{ Str::upper($row->siswa->nama_siswa) }}</td>
                    <td style="border:1px solid #000">
                        {{ Str::upper($row->siswa->tingkatan . ' ' . $row->siswa->jurusan->jurusan . ' ' . $row->siswa->no_kelas) }}
                    </td>
                    <td style="border:1px solid #000">{{ Str::upper($row->status) }}</td>

                    <td style="border:1px solid #000">{{ $row->siswa->sesi }}</td>
                </tr>
            @endif
        @endforeach
    @endforeach
</table>
