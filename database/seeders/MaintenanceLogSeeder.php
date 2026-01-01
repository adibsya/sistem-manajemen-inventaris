<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\User;
use App\Models\MaintenanceLog;
class MaintenanceLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asset = Asset::first();
        $teknisi = User::where('role', 'teknisi')->first();

        if ($asset && $teknisi) {
            MaintenanceLog::create([
                'asset_id' => $asset->id,
                'user_id' => $teknisi->id,
                'action_taken' => 'Pembersihan fan internal dan penggantian pasta pendingin (Thermal Paste).',
                'cost' => 75000,
                'completion_date' => now()->subDays(5), // Selesai 5 hari yang lalu
            ]);
        }
    }
}
