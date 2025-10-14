<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bidang;
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
        $uuidAdmin = Str::uuid()->toString();
        Bidang::create([
            'id' => Str::uuid()->toString(),
            'kode_bidang' => 'BKBP',
            'nama_bidang' => 'Badan Kesatuan Bangsa dan Politik Kabupaten Buleleng'
        ]);
        Bidang::create([
            'id' => $uuidAdmin,
            'kode_bidang' => 'ARSIKA Buleleng',
            'nama_bidang' => 'Arsip Digital Kesbangpol Buleleng'
        ]);
        Bidang::create([
            'id' => Str::uuid()->toString(),
            'kode_bidang' => 'BID-I',
            'nama_bidang' => 'Bidang Pengembangan Nilai-nilai Kebangsaan'
        ]);
        Bidang::create([
            'id' => Str::uuid()->toString(),
            'kode_bidang' => 'BID-II',
            'nama_bidang' => 'Bidang Kewaspadaan Nasional'
        ]);
        Bidang::create([
            'id' => Str::uuid()->toString(),
            'kode_bidang' => 'BID-III',
            'nama_bidang' => 'Bidang Pengembangan Budaya Politik'
        ]);
        Bidang::create([
            'id' => Str::uuid()->toString(),
            'kode_bidang' => 'UMUM',
            'nama_bidang' => 'Sekretariat Kesbangpol'
        ]);

        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => $uuidAdmin,
            'name' => 'I Kadek Naryasa, S.Kom',
            'role' => 'admin',
            'email' => 'arsikabuleleng@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'jabatan' => "Pranata Komputer Ahli Pertama",
            'nip' => '200206092025061001'
        ]);

        $this->call([
            GoogleAccessTokenSeeder::class,
        ]);
    }
}
