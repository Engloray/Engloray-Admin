<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User 1
        User::updateOrCreate(
            ['email' => 'admin@engloray.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Engl0r@y-#2025'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Admin User 2
        User::updateOrCreate(
            ['email' => 'sales@engloray.com'],
            [
                'name' => 'Engloray',
                'password' => Hash::make('Engl0r@y-#sales'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
