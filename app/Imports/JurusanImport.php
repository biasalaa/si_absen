<?php

namespace App\Imports;

use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JurusanImport implements ToModel,WithHeadingRow
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
        $namaData = $row['jurusan'] ?? null;
  
        if (!$namaData) {
            $this->error = true;
            $this->pesan = "Format Excel Tidak Sesuai";
            return ;
        }

        $namaData = strtoupper($namaData);
        $cek = Jurusan::where('jurusan',$namaData)->first();
        if($cek){
            $this->gagal++;
             return;
            };


        $this->berhasil++;
        return new Jurusan([
            'jurusan' =>  $namaData,
          
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
