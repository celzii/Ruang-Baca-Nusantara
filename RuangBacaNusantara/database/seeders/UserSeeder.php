<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Ambil role yang ada
        $adminRole = Role::where('name', 'Admin')->first();
        $pegawaiRole = Role::where('name', 'Pegawai')->first();
        $mahasiswaRole = Role::where('name', 'Mahasiswa')->first();

        // Pastikan role_id yang dimasukkan adalah ID yang valid
        User::create([
            'name' => 'Prof. Brice Grimes',
            'email' => 'evans.lesch@example.org',
            'password' => bcrypt('password123'),
            'role_id' => $adminRole->id,  // Ambil role_id yang valid
            'gender' => 'male',
            'mobileNumber' => '081234567890',
            'address' => 'Jalan Raya No. 1',
        ]);
            
        // Lakukan hal yang sama untuk user lainnya
        User::create([
            'name' => 'Chelsea Shelin Purnaria',
            'email' => 'admin123@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => $adminRole->id,
            'gender' => 'female',
            'mobileNumber' => '081234567891',
            'address' => 'Jalan Raya No. 2',
        ]);

        // Tambahkan user lain sesuai dengan kebutuhan Anda
    }
}
