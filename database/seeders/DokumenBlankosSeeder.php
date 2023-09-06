<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenBlankosSeeder extends Seeder
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
                'tanggal' => '2023-08-20',
                'nama_dok' => 'test',
                'file_doct' => 'Contoh Penulisan Ijazah dan SKHU MDTA 2023.pdf',
                'created_at' => '2023-08-20 06:30:14',
                'updated_at' => '2023-08-20 06:30:14',
            ],
            [
                'id' => 2,
                'tanggal' => '2023-08-21',
                'nama_dok' => 'test',
                'file_doct' => 'Contoh Penulisan Ijazah dan SKHU MDTA 2023.pdf',
                'created_at' => '2023-08-20 06:32:57',
                'updated_at' => '2023-08-20 06:32:57',
            ],
            [
                'id' => 3,
                'tanggal' => '2023-08-23',
                'nama_dok' => 'test12',
                'file_doct' => 'Contoh Penulisan Ijazah dan SKHU MDTA 2023.pdf',
                'created_at' => '2023-08-20 06:33:53',
                'updated_at' => '2023-08-20 06:35:59',
            ],
        ];

        DB::table('dokumen_blankos')->insert($data);
    }
}
