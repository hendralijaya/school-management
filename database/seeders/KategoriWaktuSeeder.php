<?php

namespace Database\Seeders;

use App\Models\KategoriWaktu;
use Illuminate\Database\Seeder;

class KategoriWaktuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [['nama' => 'Lesson', 'status' => 'A'], ['nama' => 'Break', 'status' => 'A']];
        // insert data to database using model
        KategoriWaktu::insert($data);
    }
}
