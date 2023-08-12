<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JabatanGuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaJabatanGuru = ["Honorer", "Kepala Sekolah", "Guru Besar", "Guru Tetap", "Wakil Kepala Sekolah"];
        return [
            'nama' => $this->faker->unique()->randomElement($namaJabatanGuru),
            'status' => 'A',
        ];
    }
}
