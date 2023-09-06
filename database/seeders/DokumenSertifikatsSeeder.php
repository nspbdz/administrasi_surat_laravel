<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSertifikatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'tanggal' => '2023-08-19',
                'nama_dok' => 'test999',
                'file_dok' => 'Contoh Penulisan Ijazah dan SKHU MDTA 2023.pdf',
                'created_at' => '2023-08-19 08:08:35',
                'updated_at' => '2023-08-19 08:25:13',
            ],
        ];

        DB::table('dokumen_sertifikats')->insert($data);
    }
}
