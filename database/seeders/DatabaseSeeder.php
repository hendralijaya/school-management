<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\GuruSeeder;
use Database\Seeders\HariSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\KelasSeeder;
use Database\Seeders\RuangSeeder;
use Database\Seeders\SiswaSeeder;
use Database\Seeders\WaktuSeeder;
use Database\Seeders\DiskonSeeder;
use Database\Seeders\JadwalSeeder;
use Database\Seeders\JurusanSeeder;
use Database\Seeders\OrangTuaSeeder;
use Database\Seeders\KurikulumSeeder;
use Database\Seeders\JabatanGuruSeeder;
use Database\Seeders\BiayaSekolahSeeder;
use Database\Seeders\KategoriHariSeeder;
use Database\Seeders\TingkatKelasSeeder;
use Database\Seeders\KategoriWaktuSeeder;
use Database\Seeders\MataPelajaranSeeder;
use Database\Seeders\KategoriKegiatanSeeder;
use Database\Seeders\JenisTingkatLombaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            JabatanGuruSeeder::class,
            OrangTuaSeeder::class,
            SiswaSeeder::class,
            GuruSeeder::class,
            KategoriWaktuSeeder::class,
            KategoriHariSeeder::class,
            WaktuSeeder::class,
            HariSeeder::class,
            MataPelajaranSeeder::class,
            JurusanSeeder::class,
            RuangSeeder::class,
            JenisTingkatLombaSeeder::class,
            KategoriKegiatanSeeder::class,
            BiayaSekolahSeeder::class,
            DiskonSeeder::class,
            KurikulumSeeder::class,
            TingkatKelasSeeder::class,
            KelasSeeder::class,
            JadwalSeeder::class,
        ]);
    }
}
