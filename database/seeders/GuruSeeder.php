<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Clearing guru table
        Guru::query()->delete();

        // // Creating 5 guru
        Guru::factory()->count(50)->create();
    }
}
