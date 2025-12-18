<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bidang;
use App\Models\KodeKlasifikasi;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            GoogleAccessTokenSeeder::class,
            KodeKlasifikasi000Seeder::class,
            KodeKlasifikasi100Seeder::class,
            KodeKlasifikasi200Seeder::class,
            KodeKlasifikasi300Seeder::class,
            KodeKlasifikasi400Seeder::class,
            KodeKlasifikasi400P2Seeder::class,
            KodeKlasifikasi500Seeder::class,
            KodeKlasifikasi500P2Seeder::class,
            KodeKlasifikasi500P3Seeder::class,
            KodeKlasifikasi600Seeder::class,
            KodeKlasifikasi700Seeder::class,
            KodeKlasifikasi800Seeder::class,
            KodeKlasifikasi900Seeder::class,
        ]);
    }
}
