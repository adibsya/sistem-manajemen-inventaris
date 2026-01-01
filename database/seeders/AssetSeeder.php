<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Room;
use App\Models\Asset;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID pertama dari kategori dan ruangan agar tidak error
        $category = Category::first();
        $room = Room::first();

        if ($category && $room) {
            Asset::create([
                'category_id' => $category->id,
                'room_id' => $room->id,
                'code' => 'INV-ELK-001',
                'name' => 'Laptop MacBook Air M2',
                'brand' => 'Apple',
                'purchase_date' => '2024-01-15',
                'condition' => 'bagus',
            ]);

            Asset::create([
                'category_id' => $category->id,
                'room_id' => $room->id,
                'code' => 'INV-ELK-002',
                'name' => 'Proyektor Epson EB-X100',
                'brand' => 'Epson',
                'purchase_date' => '2023-05-10',
                'condition' => 'rusak ringan',
            ]);
        }
    }
}
