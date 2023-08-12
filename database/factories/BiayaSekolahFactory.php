<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BiayaSekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaBiayaSekolah = ["SPP", "Uang Gedung", "Uang Seragam", "Uang Kegiatan", "Uang Praktikum"];
        return [
            'nama' => $this->faker->unique()->randomElement($namaBiayaSekolah),
            'harga' => $this->faker->numberBetween(100000, 10000000),
            'status' => 'A',
        ];
    }
}
