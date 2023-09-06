<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin FKDT',
            'username' => 'admin',
            'email' => 'nspbdz@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $user = User::create([
            'name' => 'Sekretaris FKDT ',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $dpc = User::create([
            'name' => 'Dewan Pengurus Cabang ',
            'username' => 'dpc',
            'email' => 'dpc@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $dpp = User::create([
            'name' => 'Dewan Pengurus Pusat ',
            'username' => 'dpp',
            'email' => 'dpp@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $dpw = User::create([
            'name' => 'Dewan Pengurus Wilayah ',
            'username' => 'dpw',
            'email' => 'dpw@gmail.com',
            'password' => bcrypt('12345678')
        ]);



        // admin
        $roleAdmin = Role::create(['name' => 'Admin', 'code' => 'admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $keys = [0, 1, 4, 7, 10, 13, 16, 19, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32,33, 34,36,37,39,40,42];
        $selectedPermissionsAdmin = [];

        foreach ($keys as $key) {
            // dd($key);
            if (array_key_exists($key + 1, $permissions)) {
                $selectedPermissionsAdmin[$key + 1] = $permissions[$key + 1];
            }
        }
        // dd($selectedPermissionsAdmin);
        $roleAdmin->syncPermissions($selectedPermissionsAdmin);
        $admin->assignRole([$roleAdmin->id]);
        // admin

        // user
        $role = Role::create(['name' => 'User', 'code' => 'user']);
        // $permissions = array_slice($permissions, 1, 24, true);
        $keys = [0, 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,33, 34,35,36, 37,38,39, 40,41,42, 43,44,45];
        $selectedPermissionsRole = [];

        foreach ($keys as $key) {
            // dd($key);
            if (array_key_exists($key + 1, $permissions)) {
                $selectedPermissionsRole[$key + 1] = $permissions[$key + 1];
            }
        }
        $role->syncPermissions($selectedPermissionsRole);
        $user->assignRole([$role->id]);
        // user



        // dp
        $roleDpc = Role::create(['name' => 'dewan pengurus cabang', 'code' => 'dpc']);
        $roleDpw = Role::create(['name' => 'dewan pengurus wilayah', 'code' => 'dpw']);
        $roleDpp = Role::create(['name' => 'dewan pengurus pusat', 'code' => 'dpp']);
        $permissions = Permission::pluck('id', 'id')->all();
        $keys = [1, 2, 3, 10, 11, 12, 16, 17, 18, 19, 20, 21, 22, 26, 32];
        $selectedPermissionsDp = [];

        foreach ($keys as $key) {
            // dd($key);
            if (array_key_exists($key + 1, $permissions)) {
                $selectedPermissionsDp[$key + 1] = $permissions[$key + 1];
            }
        }

        // dd($selectedPermissionsDp);
        // dpc
        $roleDpc->syncPermissions($selectedPermissionsDp);
        $dpc->assignRole([$roleDpc->id]);
        // dpc

        //dpp
        $roleDpp->syncPermissions($selectedPermissionsDp);
        $dpp->assignRole([$roleDpp->id]);
        //dpp

        //dpw
        $roleDpw->syncPermissions($selectedPermissionsDp);
        $dpw->assignRole([$roleDpw->id]);
        //dpw

    }
}
