<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\User;
use App\Models\JabatanGuru;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    protected static $createdTeachersCount = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');

        // Retrieve the IDs of 'Kepala Sekolah' and 'Wakil Kepala Sekolah' roles
        $kepalaSekolahId = JabatanGuru::where('nama', 'Kepala Sekolah')->value('id');
        $wakilKepalaSekolahId = JabatanGuru::where('nama', 'Wakil Kepala Sekolah')->value('id');

        // Assign the role IDs based on desired distribution
        if (self::$createdTeachersCount < 2) {
            $jabatanGuruId = self::$createdTeachersCount === 0 ? $kepalaSekolahId : $wakilKepalaSekolahId;
        } else {
            $jabatanGuruId = JabatanGuru::where('nama', 'Guru Tetap')->value('id'); // Adjust as needed
        }

        // Increment the created teachers count
        self::$createdTeachersCount++;

        // Generate the phone number without any non-digit characters
        $phoneNumber = preg_replace('/\D/', '', $faker->phoneNumber);

        // Add the international code at the beginning (+62 for Indonesia)
        $phoneNumber = '+62' . substr($phoneNumber, 1);
        return [
            'nama' => $faker->name,
            'no_wa' => $phoneNumber,
            'gender' => $faker->randomElement(['M', 'F']),
            'tgl_bergabung' => $faker->dateTimeBetween('-6 years', 'now')->format('Y-m-d'),
            'tgl_lahir' => $faker->dateTimeBetween('-60 years', 'now')->format('Y-m-d'),
            'alamat' => $faker->address,
            'jabatan_guru_id' => $jabatanGuruId,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Guru $guru) {
            $faker = \Faker\Factory::create('id_ID');
            $user = new User([
                'email' => $faker->unique()->safeEmail,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'status' => $faker->randomElement(['A', 'D']),
                'role_id' => 3,
            ]);

            $guru->user()->save($user);
        });
    }
}
