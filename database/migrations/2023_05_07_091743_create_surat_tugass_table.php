<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTugassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_tugass', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_surat', ['Surat Tugas']);
            $table->integer('instansis_id');
            $table->string('tempat_surat');
            $table->date('tanggal_surat');
            $table->string('no_surat');
            $table->string('nama_pegawai');
            $table->string('jabatan');
            $table->date('tanggal_tugas');
            $table->string('tempat_tugas');
            $table->text('isi_surat');
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
        Schema::dropIfExists('surat_tugass');
    }
}
