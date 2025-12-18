<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bidang;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uuidAdmin = Str::uuid()->toString();
        $uuidBidang1 = Str::uuid()->toString();
        $uuidBidang2 = Str::uuid()->toString();
        $uuidBidang3 = Str::uuid()->toString();
        $uuidUmum = Str::uuid()->toString();
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
            'id' => $uuidBidang1,
            'kode_bidang' => 'BID-I',
            'nama_bidang' => 'Bidang Pengembangan Nilai-nilai Kebangsaan'
        ]);
        Bidang::create([
            'id' => $uuidBidang2,
            'kode_bidang' => 'BID-II',
            'nama_bidang' => 'Bidang Kewaspadaan Nasional'
        ]);
        Bidang::create([
            'id' => $uuidBidang3,
            'kode_bidang' => 'BID-III',
            'nama_bidang' => 'Bidang Pengembangan Budaya Politik'
        ]);
        Bidang::create([
            'id' => $uuidUmum,
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

        // bidang 1
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => $uuidBidang1,
            'name' => 'Operator Bidang 1',
            'role' => 'operator',
            'email' => 'operator.bidang1@arsika.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'jabatan' => "Jabatan Operator xxx ",
            'nip' => '1111'
        ]);
        // bidang 1
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => $uuidBidang1,
            'name' => 'Legalizer Bidang 1',
            'role' => 'legalizer',
            'email' => 'legalizer.bidang1@arsika.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'jabatan' => "Jabatan Legalizer xxx ",
            'nip' => '11111'
        ]);
        //bidang 2
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => $uuidBidang2,
            'name' => 'Operator Bidang 2',
            'role' => 'operator',
            'email' => 'operator.bidang2@arsika.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'jabatan' => "Jabatan Operator xxx ",
            'nip' => '2222'
        ]);
        //bidang 2
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => $uuidBidang2,
            'name' => 'Legalizer Bidang 2',
            'role' => 'legalizer',
            'email' => 'legalizer.bidang2@arsika.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'jabatan' => "Jabatan Legalizer xxx ",
            'nip' => '22221'
        ]);
        //bidang 3
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => $uuidBidang3,
            'name' => 'Operator Bidang 3',
            'role' => 'operator',
            'email' => 'operator.bidang3@arsika.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'jabatan' => "Jabatan Operator xxx ",
            'nip' => '3333'
        ]);
        //bidang 3
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => $uuidBidang3,
            'name' => 'Legalizer Bidang 3',
            'role' => 'legalizer',
            'email' => 'legalizer.bidang3@arsika.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'jabatan' => "Jabatan Legalizer xxx ",
            'nip' => '33331'
        ]);
        // umum
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => $uuidUmum,
            'name' => 'Operator Sekretariat',
            'role' => 'operator',
            'email' => 'operator.sekretariat@arsika.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'jabatan' => "Jabatan Operator xxx ",
            'nip' => '0000'
        ]);
        // umum
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => $uuidUmum,
            'name' => 'Legalizer Sekretariat',
            'role' => 'legalizer',
            'email' => 'legalizer.sekretariat@arsika.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'jabatan' => "Jabatan Legalizer xxx ",
            'nip' => '00001'
        ]);
    }
}
