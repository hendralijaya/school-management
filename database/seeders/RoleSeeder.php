<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing roles (optional)
        Role::query()->delete();

        // Define role names
        $roles = [
            'Admin',
            'Pelajar / Student',
            'Guru / Teacher',
            'Orang Tua / Parent',
        ];

        // Create role records
        foreach ($roles as $role) {
            Role::create([
                'nama' => $role,
                'status' => 'A',
            ]);
        }
    }
}
