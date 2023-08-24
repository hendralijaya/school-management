<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'mata_pelajaran_id' => 1,
                'guru_id' => 1,
                'ruang_id' => 1,
                'kelas_id' => 1,
                'hari_id' =>  1,
                'waktu_id' => 1,
                'status' => 'A',
            ],
            [
                'mata_pelajaran_id' => 2,
                'guru_id' => 2,
                'ruang_id' => 2,
                'kelas_id' => 2,
                'hari_id' =>  2,
                'waktu_id' => 2,
                'status' => 'A',
            ],
            [
                'mata_pelajaran_id' => 3,
                'guru_id' => 3,
                'ruang_id' => 3,
                'kelas_id' => 3,
                'hari_id' =>  3,
                'waktu_id' => 3,
                'status' => 'A',
            ],
            [
                'mata_pelajaran_id' => 4,
                'guru_id' => 4,
                'ruang_id' => 4,
                'kelas_id' => 4,
                'hari_id' =>  4,
                'waktu_id' => 4,
                'status' => 'A',
            ],
            [
                'mata_pelajaran_id' => 5,
                'guru_id' => 5,
                'ruang_id' => 5,
                'kelas_id' => 5,
                'hari_id' =>  5,
                'waktu_id' => 5,
                'status' => 'A',
            ]
        ];

        Jadwal::insert($data);
    }
}
