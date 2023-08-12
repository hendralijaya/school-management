<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Clearing Hari table
        KategoriKegiatan::query()->delete();

        // // Creating Hari
        KategoriKegiatan::factory()->count(5)->create();
    }
}
