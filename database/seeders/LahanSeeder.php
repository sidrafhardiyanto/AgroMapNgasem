<?php

namespace Database\Seeders;

use App\Models\Lahan;
use Illuminate\Database\Seeder;

class LahanSeeder extends Seeder
{
    public function run(): void
    {
        $lahans = [
            [
                'pemilik' => 'Pak Sidra',
                'luas' => 2500.00,
                'lokasi' => 'Lat: -6.647621068203892, Long: 110.72895884513856',
                'latitude' => -6.647621068203892,
                'longitude' => 110.72895884513856,
                'keterangan' => 'Lahan padi di sebelah utara desa'
            ],
            [
                'pemilik' => 'Bu Febri',
                'luas' => 1800.00,
                'lokasi' => 'Lat: -6.658938358517294, Long: 110.72066545486452',
                'latitude' => -6.658938358517294,
                'longitude' => 110.72066545486452,
                'keterangan' => 'Lahan jagung dekat sungai'
            ],
            [
                'pemilik' => 'Pak Hardiyanto',
                'luas' => 3000.00,
                'lokasi' => 'Lat: -6.652395248833365, Long: 110.71720004081727',
                'latitude' => -6.652395248833365,
                'longitude' => 110.71720004081727,
                'keterangan' => 'Lahan kedelai di sebelah barat desa'
            ],
            [
                'pemilik' => 'Bu Yanti',
                'luas' => 2000.00,
                'lokasi' => 'Lat: -6.650285237221061, Long: 110.72796106338502',
                'latitude' => -6.650285237221061,
                'longitude' => 110.72796106338502,
                'keterangan' => 'Lahan sayuran organik'
            ],
            [
                'pemilik' => 'Pak Hadi',
                'luas' => 2800.00,
                'lokasi' => 'Lat: -6.657233322049246, Long: 110.72949528694154',
                'latitude' => -6.657233322049246,
                'longitude' => 110.72949528694154,
                'keterangan' => 'Lahan padi sistem SRI'
            ]
        ];

        foreach ($lahans as $lahan) {
            Lahan::create($lahan);
        }
    }
}
