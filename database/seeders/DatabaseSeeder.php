<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\HariSeeder;
use Database\Seeders\JurusanSeeder;
use Database\Seeders\MataPelajaranSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            OrangTuaSeeder::class,
            SiswaSeeder::class,
            GuruSeeder::class,
            HariSeeder::class,
            WaktuSeeder::class,
            MataPelajaranSeeder::class,
            JurusanSeeder::class,
            RuangSeeder::class,
        ]);
    }
}
