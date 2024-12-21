<?php

namespace Database\Seeders;

use App\Models\PenyuluhPetaniLapangan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PPLSeeder extends Seeder
{
    public function run(): void
    {
        $ppls = [
            [
                'Nama' => 'Ahmad Supriyanto',
                'Email' => 'ahmad.supriyanto@gmail.com',
                'Password' => Hash::make('password123'),
                'No_Telepon' => '081234567890'
            ],
            [
                'Nama' => 'Siti Aminah',
                'Email' => 'siti.aminah@gmail.com',
                'Password' => Hash::make('password123'),
                'No_Telepon' => '081234567891'
            ],
            [
                'Nama' => 'Budi Santoso',
                'Email' => 'budi.santoso@gmail.com',
                'Password' => Hash::make('password123'),
                'No_Telepon' => '081234567892'
            ],
            [
                'Nama' => 'Dewi Lestari',
                'Email' => 'dewi.lestari@gmail.com',
                'Password' => Hash::make('password123'),
                'No_Telepon' => '081234567893'
            ],
            [
                'Nama' => 'Eko Prasetyo',
                'Email' => 'eko.prasetyo@gmail.com',
                'Password' => Hash::make('password123'),
                'No_Telepon' => '081234567894'
            ]
        ];

        foreach ($ppls as $ppl) {
            PenyuluhPetaniLapangan::create($ppl);
        }
    }
}
