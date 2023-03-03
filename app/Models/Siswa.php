<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";
    protected $fillable = ['nama_siswa','nisn','sesi','id_ajaran','id_ruangan','id_jurusan','tingkatan','no_kelas'];

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
}
