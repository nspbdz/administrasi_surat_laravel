<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratUndangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_undangans', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_surat', ['Surat Undangan']);
            $table->integer('instansis_id');
            $table->string('tempat_surat');
            $table->date('tanggal_surat');
            $table->string('no_surat');
            $table->string('pengirim');
            $table->string('perihal');
            $table->string('pnrm_surat'); //penerimaSurat
            $table->string('alamat_surat');
            $table->text('isi_surat');
            $table->date('tanggal_keg');
            $table->string('waktu_keg');
            $table->string('tempat_keg');
            $table->text('acara');
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
        Schema::dropIfExists('surat_undangans');
    }
}
