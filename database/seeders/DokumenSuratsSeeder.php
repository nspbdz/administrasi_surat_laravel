<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSuratsSeeder extends Seeder
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
                'nama_dok' => 'test88',
                'file_dok' => 'Contoh Penulisan Ijazah dan SKHU MDTA 2023.pdf',
                'created_at' => '2023-08-19 08:08:07',
                'updated_at' => '2023-08-19 08:26:23',
            ],
        ];

        DB::table('dokumen_surats')->insert($data);
    }
}
