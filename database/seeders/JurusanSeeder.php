<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'IPA',
                'status' => 'A',
            ],
            [
                'nama' => 'IPS',
                'status' => 'A',
            ],
            [
                'nama' => 'Bahasa',
                'status' => 'A',
            ],
        ];

        Jurusan::insert($data);
    }
}
