<?php

namespace Database\Seeders;

use App\Models\SuratUndangan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            // UserSeeder::class,
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            InstansiSeeder::class,
            SuratUndanganSeeder::class,
            DokumenBlankosSeeder::class,
            DokumenSuratsSeeder::class,
            DokumenSertifikatsSeeder::class,
            
        ]); 
    }
}
