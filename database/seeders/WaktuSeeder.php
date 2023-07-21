<?php

namespace Database\Seeders;

use App\Models\Waktu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WaktuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Waktu 1: Jam 8.00.00 - 10.00.00 (Mapel)
            [
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '10:00:00',
                'jenis_waktu' => 'mapel',
            ],
            // Waktu 2: Jam 10.00.00 - 10.30.00 (Istirahat)
            [
                'waktu_mulai' => '10:00:00',
                'waktu_selesai' => '10:30:00',
                'jenis_waktu' => 'istirahat',
            ],
            // Waktu 3: Jam 10.30.00 - 12.00.00 (Mapel)
            [
                'waktu_mulai' => '10:30:00',
                'waktu_selesai' => '12:00:00',
                'jenis_waktu' => 'mapel',
            ],
            // Waktu 4: Jam 12.00.00 - 14.00.00 (Mapel)
            [
                'waktu_mulai' => '12:00:00',
                'waktu_selesai' => '14:00:00',
                'jenis_waktu' => 'mapel',
            ],
        ];

        Waktu::insert($data);
    }
}
