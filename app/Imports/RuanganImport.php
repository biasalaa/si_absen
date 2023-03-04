<?php

namespace App\Imports;

use App\Models\Ruangan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RuanganImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct() {

        $this->error = false;
        $this->pesan = "";
        $this->berhasil = 0;
        $this->gagal = 0;
        $this->total = 0;

    }
    public function model(array $row)
    {
        $this->total++;
        $namaData = $row['ruangan'] ?? null;
        $teknisiData = $row['teknisi'] ?? null;
  
        if (!$namaData || !$teknisiData) {
            $this->error = true;
            $this->pesan = "Format Excel Tidak Sesuai";
            return ;
        }

        $namaData = strtoupper($namaData);


        $this->berhasil++;
         $no_ruangan = Ruangan::count()+1;
        // insert data to database
         $month = date('m');
        if($month <= '06'){
            $tahun = date('Y',strtotime("-1 Year"))."/".date('Y');;
            $semester = "genap";
        }else{
             $tahun = date('Y')."/".date('Y',strtotime("+1 year"));
            $semester = "ganjil";
        }
        $id_ajaran = Tahun_Ajaran::where('tahun',$tahun)->where('semester',$semester)->first()->id;

        if(!$id_ajaran)return;
        return new Ruangan([
            'nama_ruangan' =>  $namaData,
            'nama_teknisi' =>  $teknisiData,
            'no_ruangan'=>$no_ruangan,
            'id_ajaran'=>$id_ajaran,
          
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
