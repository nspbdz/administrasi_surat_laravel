<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instansis')->insert([
            'id' => 1,
            'nama_instansi' => 'FKDT Lohbener',
            'cabang_instansi' => 'KECAMATAN LOHBENER',
            'nama_pj' => 'Taupik Tabroni',
            'jabatan' => 'Ketua FKDT Kecamatan Lohbener',
            'nip' => '19876542022457',
            'alamat' => 'Jl. Raya By Pass Kiajaran Wetan Kantor DKM Masjid Hidayatul Muttaqien Kec. Lohbener Kab. Indramayu-Jawa Barat',
            'nmr_telepon' => '+62 899-3535-520',
            'kode_instansi' => 'FKDT-LHBNR',
            'logo' => 'logo fkdt.jpg',
            'tanda_tangan' => 'ttd fkdt.png',
            'cap_surat' => 'cap fkdt.png',
            'role_code' => 'dpc',
            'created_at' => '2023-06-17 13:16:41',
            'updated_at' => '2023-06-17 13:16:41',
        ]);
    }
}
