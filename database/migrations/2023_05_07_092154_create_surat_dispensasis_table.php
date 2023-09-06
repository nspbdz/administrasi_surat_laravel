<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratDispensasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_dispensasis', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_surat', ['Surat Dispensasi']);
            $table->integer('instansis_id');
            $table->string('tempat_surat');
            $table->date('tanggal_surat');
            $table->string('no_surat');
            $table->string('nama_siswa');
            $table->string('asal_mdta');
            $table->date('tanggal_dispensasi');
            $table->string('tempat_dispensasi');
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
        Schema::dropIfExists('surat_dispensasis');
    }
}
