<?php

// database/seeders/Ro// database/seeders/RoleSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Membuat permissions
        Permission::create(['name' => 'manage books']);
        Permission::create(['name' => 'manage loans']);
        
        // Membuat roles dan memberi permission
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(['manage books', 'manage loans']);
        
        $pegawaiRole = Role::create(['name' => 'Pegawai']);
        $pegawaiRole->givePermissionTo(['manage loans']);
    }
}
