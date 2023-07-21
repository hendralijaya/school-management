<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Clearing MataPelajaran table
        MataPelajaran::query()->delete();

        // // Creating MataPelajaran
        MataPelajaran::factory()->count(12)->create();
    }
}
