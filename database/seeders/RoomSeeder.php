<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            'Ruang Kepala Sekolah',
            'Ruang Kelas 1',
            'Ruang Kelas 2',
            'Ruang Kelas 3',
            'Ruang Laboratorium Komputer',
            'Ruang Laboratorium IPA',
            'Ruang Perpustakaan',
            'Ruang UKS',
            'Ruang Guru',
            'Ruang Tata Usaha',
            'Gudang',
        ];
        foreach ($rooms as $room) {
            \App\Models\Room::create(['name' => $room]);
        }
    }
}
