<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }

    public function registerPermissions()
    {

        // 'user',
        // 'surat_pemberitahuan',
        // 'surat_tugas',
        // 'surat dispensasi',
        // 'surat undangan',
        // 'dokumen',
        // 'jadwal_surat',
        // 'nama_instansi',

        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'jadwal_surat']);
        Permission::create(['name' => 'surat_masuk']);
        Permission::create(['name' => 'surat_pemberitahuan']);
        Permission::create(['name' => 'surat_tugas']);
        Permission::create(['name' => 'surat_dispensasi']);
        Permission::create(['name' => 'surat_undangan']);
        Permission::create(['name' => 'dokumen']);
        Permission::create(['name' => 'user']);
        Permission::create(['name' => 'nama_instansi']);

        $permissions = [
            'user',
            'surat_pemberitahuan',
            'surat_tugas',
            'surat_dispensasi',
            'surat_undangan',
            'dokumen',
            'jadwal_surat',
            'nama_instansi',
            'surat_masuk',
            'dashboard',
            // Izin-izin lainnya yang diperlukan
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
        // Tambahkan izin-izin lainnya yang diperlukan
    }
}
