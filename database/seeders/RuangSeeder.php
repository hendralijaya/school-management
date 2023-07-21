<?php

namespace Database\Seeders;

use App\Models\Ruang;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Clearing Ruang table
        Ruang::query()->delete();

        // // Creating Ruang
        Ruang::factory()->count(50)->create();
    }
}
