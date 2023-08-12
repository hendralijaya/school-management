<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KategoriKegiatan>
 */
class KategoriKegiatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaKategori = ["Milestone Jam Mengajar", "Lomba", "Pelatihan Guru", "Event", "Sertifikasi"];
        return [
            'nama' => $this->faker->unique()->randomElement($namaKategori),
            'status' => 'A',
        ];
    }
}
