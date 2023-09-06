<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Balas', 'Belum Balas']);
            $table->enum('jenis_surat', ['Pemberitahuan', 'Undangan', 'Izin']);
            $table->integer('instansis_id');
            $table->date('tanggal'); //tanggal surat masuk
            $table->string('no_surat');
            $table->string('asal_surat');
            $table->string('perihal');
            $table->string('pnrm_surat'); //penerimaSurat
            $table->string('nmr_registrasi');
            $table->string('file_surat', 255);
            $table->string('role_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuks');
    }
}
