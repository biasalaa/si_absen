<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa',50);
            $table->string('nisn',20);
            $table->integer('sesi');
            $table->integer('id_ajaran')->unsigned();
            $table->integer('id_ruangan')->unsigned();
            $table->integer('id_jurusan')->unsigned();
            $table->enum('tingkatan',['X','XI','XII']);
            $table->enum('no_kelas',[1,2,3,4,5,6]);
            $table->timestamps();
            $table->foreign('id_ajaran')->references('id')->on('tahun_ajaran')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_ruangan')->references('id')->on('ruangan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id')->on('jurusan')->onUpdate('cascade')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
