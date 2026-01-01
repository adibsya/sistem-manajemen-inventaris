<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun Teknisi (Untuk kamu simulasi support)
    User::create([
        'name' => 'Teknisi Utama',
        'email' => 'teknisi@school.com',
        'password' => bcrypt('password'),
        'role' => 'teknisi',
    ]);

    // Akun Staff (Untuk simulasi pelaporan dari guru)
    User::create([
        'name' => 'Staff Sarpras',
        'email' => 'staff@school.com',
        'password' => bcrypt('password'),
        'role' => 'staff',
    ]);
    }
}
