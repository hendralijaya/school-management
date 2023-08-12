<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisTingkatLomba;

class JenisTingkatLombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Clearing Hari table
        JenisTingkatLomba::query()->delete();

        JenisTingkatLomba::factory()->count(6)->create();
    }
}
