<?php

namespace Database\Seeders;

use App\Models\BiayaSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiayaSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BiayaSekolah::query()->delete();

        BiayaSekolah::factory()->count(5)->create();
    }
}
