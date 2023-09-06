<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [


            'user',
            'surat_pemberitahuan-index', //1
            'surat_pemberitahuan-create',
            'surat_pemberitahuan-action',
            'surat_tugas-index', //2 4
            'surat_tugas-create',
            'surat_tugas-action',
            'surat_dispensasi-index', //3 7
            'surat_dispensasi-create',
            'surat_dispensasi-action',
            'surat_undangan-index', //4 10
            'surat_undangan-create',
            'surat_undangan-action',
            'dokumen-index',    //5 13
            'dokumen-create',
            'dokumen-action',
            // 'jadwal_surat-index', //6 16
            // 'jadwal_surat-create',
            // 'jadwal_surat-action',
            'instansi-index', //7 16
            'instansi-create',
            'instansi-action',
            'surat_masuk-index', //19
            'surat_masuk-create',
            'surat_masuk-action',
            'surat_pemberitahuan-show', //22
            'surat_tugas-show',
            'surat_dispensasi-show',
            'auth', //25
            'surat_undangan-show',
            'surat_masuk-show',
            'jadwal_surat-index', //6 28
            'jadwal_surat-create',
            'jadwal_surat-action',
            'dokumen-show',    //5 31
            'instansi-show', //7
            'dashboard', //7 33
            'file_blanko-index',
            'file_blanko-action', //7 35
            'file_blanko-show', //7
            'file_surat-keluar-index',//7 37
            'file_surat-keluar-action',
            'file_surat-keluar-show', //7 39
            'file_sertifikat-index',
            'file_sertifikat-action', // 41
            'file_sertifikat-show',
            'file_blanko-create',
            'file_surat-keluar-create',//7 37
            'file_sertifikat-create',

            // 'file-blanko',
            // 'file-surat-keluar',
            // 'file-sertifikat',// 42









        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // $user = User::create([
        // 	'name' => 'Hardik Savani',
        // 	'email' => 'admin@gmail.com',
        // 	'password' => bcrypt('12345678')
        // ]);
    }
}
