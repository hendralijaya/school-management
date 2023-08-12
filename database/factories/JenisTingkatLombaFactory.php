<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JenisTingkatLomba;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisTingkatLomba>
 */
class JenisTingkatLombaFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = JenisTingkatLomba::class;

    public function definition(): array
    {
        $namaJenisLomba = ["International", "National", "Regional", "Local", "School", "Other"];
        return [
            'nama' => $this->faker->unique()->randomElement($namaJenisLomba),
            'status' => 'A',
        ];
    }
}
