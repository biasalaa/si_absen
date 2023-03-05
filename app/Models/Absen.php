<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
      protected $table = "absen";
    protected $fillable = ['id_siswa','id_ajaran','status'];

     public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,'id_jurusan');
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class,'id_ruangan');
    }
    public function tahun_ajaran()
    {
        return $this->belongsTo(Tahun_Ajaran::class,'id_ajaran');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'id_siswa');
    }
}
