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
            [
                'kategori_waktu_id' => 1,
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '09:00:00',
            ],
            [
                'kategori_waktu_id' => 1,
                'waktu_mulai' => '09:00:00',
                'waktu_selesai' => '10:00:00',
            ],
            [
                'kategori_waktu_id' => 1,
                'waktu_mulai' => '10:00:00',
                'waktu_selesai' => '11:00:00',
            ],
            [
                'kategori_waktu_id' => 1,
                'waktu_mulai' => '11:00:00',
                'waktu_selesai' => '12:00:00',
            ],
            [
                'kategori_waktu_id' => 2,
                'waktu_mulai' => '12:00:00',
                'waktu_selesai' => '13:00:00',
            ],
            [
                'kategori_waktu_id' => 1,
                'waktu_mulai' => '13:00:00',
                'waktu_selesai' => '14:00:00',
            ],
            [
                'kategori_waktu_id' => 1,
                'waktu_mulai' => '14:00:00',
                'waktu_selesai' => '15:00:00',
            ],
        ];

        Waktu::insert($data);
    }
}
