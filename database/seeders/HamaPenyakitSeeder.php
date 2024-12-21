<?php

namespace Database\Seeders;

use App\Models\HamaPenyakit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HamaPenyakitSeeder extends Seeder
{
    public function run(): void
    {
        $hamaPenyakits = [
            [
                'ID_Tanaman' => 1,
                'nama' => 'Wereng Coklat',
                'jenis' => 'hama',
                'tingkat_serangan' => 'sedang',
                'tanggal_laporan' => Carbon::now()->subDays(5),
                'gejala' => 'Ditemukan wereng coklat di beberapa rumpun padi',
                'penanganan' => 'Aplikasi pestisida nabati dan predator alami',
                'status' => 'proses'
            ],
            [
                'ID_Tanaman' => 2,
                'nama' => 'Bulai',
                'jenis' => 'penyakit',
                'tingkat_serangan' => 'ringan',
                'tanggal_laporan' => Carbon::now()->subDays(3),
                'gejala' => 'Terdapat bercak putih pada daun jagung',
                'penanganan' => 'Penyemprotan fungisida',
                'status' => 'teratasi'
            ],
            [
                'ID_Tanaman' => 3,
                'nama' => 'Ulat Grayak',
                'jenis' => 'hama',
                'tingkat_serangan' => 'berat',
                'tanggal_laporan' => Carbon::now()->subDays(7),
                'gejala' => 'Serangan ulat pada daun kedelai cukup parah',
                'penanganan' => 'Penyemprotan insektisida dan pemasangan perangkap',
                'status' => 'proses'
            ],
            [
                'ID_Tanaman' => 4,
                'nama' => 'Bercak Daun',
                'jenis' => 'penyakit',
                'tingkat_serangan' => 'ringan',
                'tanggal_laporan' => Carbon::now()->subDays(2),
                'gejala' => 'Bercak coklat pada beberapa daun bayam',
                'penanganan' => 'Pemangkasan daun yang terinfeksi',
                'status' => 'teratasi'
            ],
            [
                'ID_Tanaman' => 5,
                'nama' => 'Penggerek Batang',
                'jenis' => 'hama',
                'tingkat_serangan' => 'sedang',
                'tanggal_laporan' => Carbon::now()->subDays(10),
                'gejala' => 'Ditemukan gejala penggerek batang pada beberapa rumpun',
                'penanganan' => 'Aplikasi pestisida sistemik',
                'status' => 'proses'
            ]
        ];

        foreach ($hamaPenyakits as $hamaPenyakit) {
            HamaPenyakit::create($hamaPenyakit);
        }
    }
}
