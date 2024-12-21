<?php

namespace Database\Seeders;

use App\Models\Tanaman;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TanamanSeeder extends Seeder
{
    public function run(): void
    {
        $tanamans = [
            [
                'ID_Lahan' => 1,
                'Jenis_Tanaman' => 'Padi',
                'Varietas' => 'IR64',
                'Tanggal_Penanaman' => Carbon::now()->subDays(45),
                'Perkiraan_Panen' => Carbon::now()->addDays(45),
                'Status' => 'tumbuh',
                'Catatan' => 'Pertumbuhan normal, sudah masuk fase vegetatif'
            ],
            [
                'ID_Lahan' => 2,
                'Jenis_Tanaman' => 'Jagung',
                'Varietas' => 'Pioneer P21',
                'Tanggal_Penanaman' => Carbon::now()->subDays(30),
                'Perkiraan_Panen' => Carbon::now()->addDays(60),
                'Status' => 'tumbuh',
                'Catatan' => 'Tinggi tanaman rata-rata 50cm'
            ],
            [
                'ID_Lahan' => 3,
                'Jenis_Tanaman' => 'Kedelai',
                'Varietas' => 'Anjasmoro',
                'Tanggal_Penanaman' => Carbon::now()->subDays(60),
                'Perkiraan_Panen' => Carbon::now()->addDays(20),
                'Status' => 'tumbuh',
                'Catatan' => 'Polong sudah mulai berisi'
            ],
            [
                'ID_Lahan' => 4,
                'Jenis_Tanaman' => 'Bayam',
                'Varietas' => 'Giti Hijau',
                'Tanggal_Penanaman' => Carbon::now()->subDays(15),
                'Perkiraan_Panen' => Carbon::now()->addDays(15),
                'Status' => 'tumbuh',
                'Catatan' => 'Pertumbuhan sangat baik'
            ],
            [
                'ID_Lahan' => 5,
                'Jenis_Tanaman' => 'Padi',
                'Varietas' => 'Ciherang',
                'Tanggal_Penanaman' => Carbon::now()->subDays(75),
                'Perkiraan_Panen' => Carbon::now()->addDays(15),
                'Status' => 'tumbuh',
                'Catatan' => 'Bulir padi mulai menguning'
            ]
        ];

        foreach ($tanamans as $tanaman) {
            Tanaman::create($tanaman);
        }
    }
}
