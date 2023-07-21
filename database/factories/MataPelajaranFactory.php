<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MataPelajaran>
 */
class MataPelajaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaMapel = [
            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Fisika',
            'Kimia',
            'Biologi',
            'Sejarah',
            'Geografi',
            'Ekonomi',
            'Sosiologi',
            'Seni Budaya',
            'Pendidikan Agama',
            'Olahraga',
            'Komputer',
            'Bahasa Jepang',
            'Bahasa Mandarin',
            'Seni Musik',
            'Tata Boga',
            'Kewirausahaan',
        ];
        return [
            'nama' => $this->faker->unique()->randomElement($namaMapel),
            'kategori' => $this->faker->randomElement(['Umum', 'IPA', 'IPS', 'Bahasa']),
            'status' => $this->faker->randomElement(['A', 'D']),
        ];
    }
}
