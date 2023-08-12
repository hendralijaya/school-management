<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DiskonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaDiskon = ["Diskon Beasiswa", "Diskon Prestasi", "Diskon SPP"];
        return [
            'nama' => $this->faker->unique()->randomElement($namaDiskon),
            'harga' => $this->faker->numberBetween(100000, 1000000),
            'status' => 'A',
        ];
    }
}
