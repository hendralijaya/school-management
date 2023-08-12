<?php

namespace Database\Seeders;

use App\Models\Hari;
use Illuminate\Database\Seeder;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [['nama' => 'Senin', 'kategori_hari_id' => 1, 'status' => 'A'], ['nama' => 'Selasa', 'kategori_hari_id' => 1, 'status' => 'A'], ['nama' => 'Rabu', 'kategori_hari_id' => 1, 'status' => 'A'], ['nama' => 'Kamis', 'kategori_hari_id' => 1, 'status' => 'A'], ['nama' => 'Jumat', 'kategori_hari_id' => 1, 'status' => 'A'], ['nama' => 'Sabtu', 'kategori_hari_id' => 2, 'status' => 'A'], ['nama' => 'Minggu', 'kategori_hari_id' => 3, 'status' => 'A']];

        // insert data to database using model
        Hari::insert($data);
    }
}
