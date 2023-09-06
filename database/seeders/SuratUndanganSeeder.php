<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratUndanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surat_undangans')->insert([
            'jenis_surat' => 'Surat Undangan',
            'instansis_id' => 1,
            'tempat_surat' => 'Lohbener',
            'tanggal_surat' => '2023-06-17',
            'no_surat' => '1/FKDT-LHBNR/06/2023',
            'pengirim' => 'FKDT Kecamatan Lohbener',
            'perihal' => 'Undangan Rapat',
            'pnrm_surat' => 'Bapak/Ibu Kepala MDTA Se-Kecamatan Lohbener',
            'alamat_surat' => 'Tempat',
            'isi_surat' => '<p style="text-align: justify;">Seraya memanjatkan puji dan syukur kehadirat Allah SWT semoga kita semua senantiasa mendapatkan Taufik dan Hidayah dari Allah SWT. Aamiin.</p><p style="text-align: justify;"> Selanjutnya dengan ini kami beritahukan dan mengundang Bapak/Ibu/saudara/i Kepala MDTA se-Kecamatan Lohbener, bersamaan dengan informasi yang perlu disampaikan dan duduk bersama memusyawarahkan dan bertukar pikiran serta menyambung tali silahturahmi Madrasah se-kecamatan Lohbener.</p>',
            'tanggal_keg' => '2023-06-29',
            'waktu_keg' => '13.00 s/d Selesai',
            'tempat_keg' => 'Aula Kantor FKDT Kecamatan Lohbener',
            'role_code' => 'dpc',
            'acara' => '<p>1. Informasi dari Kabupaten;</p><p>2. UASBN 2023;</p><p>3. PAT/UKK 2023;</p><p>4. Porsadin 2023;</p><p>5. dan lain-lain.</p>',
            'created_at' => '2023-06-17 13:18:16',
            'updated_at' => '2023-06-17 13:43:15',
        ]);
    }
}
