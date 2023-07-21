<?php

namespace Database\Factories;

use App\Models\Ruang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ruang>
 */
class RuangFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */
    protected $model = Ruang::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->unique()->word . ' Room',
            'kapasitas' => $this->faker->numberBetween(20, 40),
            'status' => $this->faker->randomElement(['A', 'D']),
        ];
    }
}
