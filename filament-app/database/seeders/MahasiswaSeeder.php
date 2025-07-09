<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = [
            [
                'name' => 'Anggia Dwi Hikmah',
                'email' => 'anggiadwihikmah@gmail.com',
                'password' => Hash::make('anggia'),
            ],
            [
                'name' => 'Luffy',
                'email' => 'luffy@gmail.com',
                'password' => Hash::make('luffy'),
            ],
            [
                'name' => 'sky',
                'email' => 'sky@gmail.com',
                'password' => Hash::make('skyy'),
            ],
            [
                'name' => 'Alhaitam',
                'email' => 'alhaitam@gmail.com',
                'password' => Hash::make('alhaitam'),
            ],
            [
                'name' => 'Furina',
                'email' => 'furina@gmail.com',
                'password' => Hash::make('furina'),
            ],
            [
                'name' => 'Muhammad Habibi',
                'email' => 'habibi@gmail.com',
                'password' => Hash::make('habibi'),
            ],
            [
                'name' => 'kageyama',
                'email' => 'kageyama@gmail.com',
                'password' => Hash::make('kageyama'),
            ],
            [
                'name' => 'Regis Altare',
                'email' => 'regis@gmail.com',
                'password' => Hash::make('regis'),
            ],
            [
                'name' => 'Harris caine',
                'email' => 'harris@gmail.com',
                'password' => Hash::make('harris'),
            ],
            [
                'name' => 'Gin Gitsune Gehenna',
                'email' => 'gin@gmail.com',
                'password' => Hash::make('gin'),
            ],
        ];

        foreach ($mahasiswa as $data) {
            Mahasiswa::updateOrCreate(
                ['email' => $data['email']], 
                $data 
            );
        }
    }
}
