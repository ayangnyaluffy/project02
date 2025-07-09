<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Test User
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
                'remember_token' => Str::random(10),
            ]
        );

        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ]
        );

            User::updateOrCreate(
            ['email' => 'dosen@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ]
        );

        $this->call(MahasiswaSeeder::class);

    }
}
