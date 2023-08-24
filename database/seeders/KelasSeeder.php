<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "nama" => "1",
                "status" => "A",
                "tingkat_kelas_id" => 1,
            ],
            [
                "nama" => "2",
                "status" => "A",
                "tingkat_kelas_id" => 1,
            ],
            [
                "nama" => "3",
                "status" => "A",
                "tingkat_kelas_id" => 1,
            ],
            [
                "nama" => "4",
                "status" => "A",
                "tingkat_kelas_id" => 1,
            ],
            [
                "nama" => "5",
                "status" => "A",
                "tingkat_kelas_id" => 1,
            ],
            [
                "nama" => "6",
                "status" => "A",
                "tingkat_kelas_id" => 1,
            ],
            [
                "nama" => "7",
                "status" => "A",
                "tingkat_kelas_id" => 1,
            ],
            [
                "nama" => "8",
                "status" => "A",
                "tingkat_kelas_id" => 1,
            ],
            [
                "nama" => "9",
                "status" => "A",
                "tingkat_kelas_id" => 1,
            ],
            [
                "nama" => "10",
                "status" => "A",
                "tingkat_kelas_id" => 2,
            ],
            [
                "nama" => "11",
                "status" => "A",
                "tingkat_kelas_id" => 2,
            ],
            [
                "nama" => "12",
                "status" => "A",
                "tingkat_kelas_id" => 2,
            ],
            [
                "nama" => "10",
                "status" => "A",
                "tingkat_kelas_id" => 3,
            ],
            [
                "nama" => "11",
                "status" => "A",
                "tingkat_kelas_id" => 3,
            ],
            [
                "nama" => "12",
                "status" => "A",
                "tingkat_kelas_id" => 3,
            ],
        ];

        Kelas::insert($data);
    }
}
