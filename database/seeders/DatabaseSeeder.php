<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PPLSeeder::class,
            LahanSeeder::class,
            TanamanSeeder::class,
            HamaPenyakitSeeder::class,
        ]);
    }
}
