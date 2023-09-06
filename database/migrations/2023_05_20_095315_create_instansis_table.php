<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi');
            $table->string('cabang_instansi');
            $table->string('nama_pj');
            $table->string('jabatan');
            $table->string('nip');
            $table->string('alamat');
            $table->string('nmr_telepon');
            $table->string('kode_instansi');
            $table->string('logo', 255)->nullable();
            $table->string('tanda_tangan', 255)->nullable();
            $table->string('cap_surat', 255)->nullable();
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
        Schema::dropIfExists('instansis');
    }
}
