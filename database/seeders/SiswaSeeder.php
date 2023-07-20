<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Clearing siswa table
        Siswa::query()->delete();

        // // Creating 5 siswas
        Siswa::factory()->count(5)->create();
    }
}
