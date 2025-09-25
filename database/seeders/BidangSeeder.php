<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bidang::create([
            'id' => Str::uuid()->toString(),
            'kode_bidang' => 'BKBP',
            'nama_bidang' => 'Badan Kesatuan Bangsa dan Politik Kabupaten Buleleng'
        ]);
        Bidang::create([
            'id' => Str::uuid()->toString(),
            'kode_bidang' => 'ARSIKA',
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
    }
}
