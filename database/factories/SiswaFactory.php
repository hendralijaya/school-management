<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');
        return [
            'nama' => $faker->name,
            'no_wa' => $faker->phoneNumber,
            'gender' => $faker->randomElement(['M', 'F']),
            'tgl_bergabung' => $faker->dateTimeBetween('-6 years', 'now')->format('Y-m-d'),
            'tgl_lahir' => $faker->dateTimeBetween('-15 years', 'now')->format('Y-m-d'),
            'alamat' => $faker->address,
            'status' => $faker->randomElement(['A', 'I']),
            'user_id' => function () {
                // Replace this with the desired logic to assign user_id to siswa
                return \App\Models\User::factory()->withRoleId(3)->create()->id;
            },
        ];
    }
}
