<?php

namespace Database\Factories;

use App\Models\Hari;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hari>
 */
class HariFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Hari::class;

    public function definition(): array
    {
        $dayNames = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        return [
            'nama' => $this->faker->unique()->randomElement($dayNames),
            'status' => $this->faker->randomElement(['A', 'D']),
        ];
    }
}
