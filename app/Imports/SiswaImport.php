<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\Ruangan;
use App\Models\Siswa;
use App\Models\Tahun_Ajaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct() {

       $month = date('m');
        if($month <= '06'){
            $tahun = date('Y',strtotime("-1 Year"))."/".date('Y');;
            $semester = "ganjil";
        }else{
             $tahun = date('Y')."/".date('Y',strtotime("+1 year"));
            $semester = "genap";
        }
        $this->tahun = $tahun;
        $this->semester = $semester;
        $this->error = false;
        $this->pesan = "";
        $this->berhasil = 0;
        $this->gagal = 0;
        $this->total = 0;
    }
    public function model(array $row)
    {
        $this->total++;

        $jurusanData = $row['jurusan'] ?? null;
        $namaData = $row['nama'] ?? null;
        $nisnData = $row['nisn'] ?? null;
        $tingkatanData = $row['tingkatan'] ?? null;
        $no_kelasData = $row['no_kelas'] ?? null;
        $sesiData = $row['sesi'] ?? null;
        $ruanganData = $row['ruangan'] ?? null;
        if (!$jurusanData || !$namaData || !$nisnData || !$tingkatanData || !$no_kelasData || !$sesiData || !$ruanganData) {
            $this->error = true;
            $this->pesan = "Format Excel Tidak Sesuai";
            return ;
        }

        $jrsn = strtoupper($jurusanData);

        $id_jurusan = Jurusan::where('jurusan',$jrsn)->first();
        $id_ruangan = Ruangan::where('nama_ruangan',$ruanganData)->first();

        if($id_jurusan != null && $id_ruangan != null ){
            $id_jurusan = $id_jurusan->id;
            $id_ruangan = $id_ruangan->id;
        }else{
        $this->gagal++;

            return;
        }

        

        $id_Ajaran = Tahun_Ajaran::where('tahun',$this->tahun)->where('semester',$this->semester)->first()->id;
        if(!$id_Ajaran)return;

        $this->berhasil++;
        return new Siswa([
            'nama_siswa' =>  $namaData,
            'nisn' => $nisnData,
            'tingkatan' => $tingkatanData,
            'no_kelas' => $no_kelasData,
            'id_ruangan' => $id_ruangan,
            'sesi' => $sesiData,
            'id_jurusan' => $id_jurusan,
            'id_ajaran'=>$id_Ajaran
        ]);
    }

    public function pesan()
    {
        return $this->pesan;
    }
    public function error()
    {
        return $this->error;
    }
     public function berhasil()
    {
        $this->pesan = "
        <h5>Data Berhasil Diimport</h5>
        <ul class='mb-0'>
        <li>Total Data : $this->total</li>
        <li>Berhasil : $this->berhasil</li>
        <li>Gagal : $this->gagal</li>
        </ul>";
       return $this->pesan;
    }
}
