<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder buatanmu di sini dengan urutan yang benar
        $this->call([
            CategorySeeder::class,
            RoomSeeder::class,
            UserSeeder::class,
            AssetSeeder::class,
            DamageReportSeeder::class,
            MaintenanceLogSeeder::class,
        ]);
    }
}