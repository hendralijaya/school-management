<?php

namespace Database\Seeders;

use App\Models\TingkatKelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TingkatKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
            [
                [
                    'nama' => 'SD',
                    'status' => 'A',
                    'jurusan_id' => 3
                ],
                [
                    'nama' => 'SMP',
                    'status' => 'A',
                    'jurusan_id' => 3
                ],
                [
                    'nama' => 'SMA',
                    'status' => 'A',
                    'jurusan_id' => 2
                ],
                [
                    'nama' => 'SMA',
                    'status' => 'A',
                    'jurusan_id' => 1
                ],
            ];
        TingkatKelas::insert($data);
    }
}
