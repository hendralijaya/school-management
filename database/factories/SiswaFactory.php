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

        // Generate the phone number without any non-digit characters
        $phoneNumber = preg_replace('/\D/', '', $faker->phoneNumber);

        // Add the international code at the beginning (+62 for Indonesia)
        $phoneNumber = '+62' . substr($phoneNumber, 1);

        return [
            'nama' => $faker->name,
            'no_wa' => $phoneNumber,
            'gender' => $faker->randomElement(['M', 'F']),
            'tgl_bergabung' => $faker->dateTimeBetween('-6 years', 'now')->format('Y-m-d'),
            'tgl_lahir' => $faker->dateTimeBetween('-15 years', 'now')->format('Y-m-d'),
            'alamat' => $faker->address,
            'status' => $faker->randomElement(['A', 'D']),
            'user_id' => function () {
                // Replace this with the desired logic to assign user_id to siswa
                return \App\Models\User::factory()->withRoleId(3)->create()->id;
            },
            'orang_tua_id' => function () {
                // get random orang_tua_id from database
                return \App\Models\OrangTua::inRandomOrder()->first()->id;
            }
        ];
    }
}
