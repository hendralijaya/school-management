<?php

namespace Database\Seeders;

use App\Models\OrangTua;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Clearing orang_tua table
        OrangTua::query()->delete();

        // // Creating 5 orang_tua
        OrangTua::factory()->count(50)->create();
    }
}
