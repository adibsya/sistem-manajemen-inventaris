<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\User;
use App\Models\DamageReport;

class DamageReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data aset dan user staff yang sudah ada
        $asset = Asset::first(); 
        $staff = User::where('role', 'staff')->first();

        if ($asset && $staff) {
            DamageReport::create([
                'asset_id' => $asset->id,
                'user_id' => $staff->id,
                'description' => 'Layar laptop bergaris hijau setelah digunakan di kelas.',
                'status' => 'pending', // Baru dilaporkan
            ]);

            DamageReport::create([
                'asset_id' => $asset->id,
                'user_id' => $staff->id,
                'description' => 'Charger laptop tidak mengisi daya (mati total).',
                'status' => 'process', // Sedang dicek teknisi
            ]);
        }
    }
}
