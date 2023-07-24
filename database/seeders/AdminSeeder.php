<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Generate the phone number without any non-digit characters
        $phoneNumber = preg_replace('/\D/', '', $faker->phoneNumber);

        // Add the international code at the beginning (+62 for Indonesia)
        $phoneNumber = '+62' . substr($phoneNumber, 1);

        // call user factory
        $user = User::create([
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => 'A',
            'role_id' => 1,
        ]);

        Admin::create([
            'user_id' => $user->id,
            'nama' => 'Admin',
            'no_wa' => $phoneNumber,
            'gender' => 'M',
            'status' => 'A'
        ]);
    }
}
