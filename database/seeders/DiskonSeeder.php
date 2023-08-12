<?php

namespace Database\Seeders;

use App\Models\Diskon;
use Illuminate\Database\Seeder;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Diskon::query()->delete();

        Diskon::factory()->count(3)->create();
    }
}
