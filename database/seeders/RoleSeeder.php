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
        Role::truncate();

        // Define role names
        $roles = [
            'Admin',
            'Pelajar / Student',
            'Guru / Teacher',
        ];

        // Create role records
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }
}
