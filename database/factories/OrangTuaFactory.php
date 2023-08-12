<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrangTua>
 */
class OrangTuaFactory extends Factory
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
            'tgl_lahir' => $faker->dateTimeBetween('-60 years', 'now')->format('Y-m-d'),
            'alamat' => $faker->address,
            'status' => $faker->randomElement(['A', 'D']),
        ];
    }

    public function configure()
    {

        return $this->afterCreating(function (\App\Models\OrangTua $orangTua) {
            $faker = \Faker\Factory::create('id_ID');
            $user = new \App\Models\User([
                'email' => $faker->unique()->safeEmail,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'status' => 'A',
                'role_id' => 4,
            ]);

            $orangTua->user()->save($user);
        });
    }
}
