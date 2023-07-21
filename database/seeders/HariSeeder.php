<?php

namespace Database\Seeders;

use App\Models\Hari;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Clearing Hari table
        Hari::query()->delete();

        // // Creating Hari
        Hari::factory()->count(6)->create();
    }
}
