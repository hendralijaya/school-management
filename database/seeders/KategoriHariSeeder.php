<?php

namespace Database\Seeders;

use App\Models\KategoriHari;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriHariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [['nama' => 'School Day', 'status' => 'A'], ['nama' => 'Extra', 'status' => 'A'], ['nama' => 'Holiday', 'status' => 'A']];

        // insert data to database using model
        KategoriHari::insert($data);
    }
}
