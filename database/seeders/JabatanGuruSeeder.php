<?php

namespace Database\Seeders;

use App\Models\JabatanGuru;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JabatanGuru::query()->delete();

        JabatanGuru::factory()->count(5)->create();
    }
}
