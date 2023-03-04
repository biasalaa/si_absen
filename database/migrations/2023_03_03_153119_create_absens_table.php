<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_siswa')->unsigned();
            $table->integer('id_ajaran')->unsigned();
            $table->enum('status',['belum hadir','sakit','ijin','alpa','hadir']);
            $table->timestamps();
            $table->foreign('id_ajaran')->references('id')->on('tahun_ajaran')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id')->on('siswa')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absens');
    }
}
