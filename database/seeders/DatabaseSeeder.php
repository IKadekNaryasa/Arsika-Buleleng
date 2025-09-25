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
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => '233fc223-2a5e-444b-8302-a55f3d4ab029',
            'name' => 'Operator Bidang 1',
            'role' => 'operator',
            'email' => 'bidang1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => '5ffcc97d-f265-4196-bb52-4ef936f4cbfd',
            'name' => 'Operator Bidang II',
            'role' => 'operator',
            'email' => 'bidang2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => 'd86439be-4c13-4589-8f6a-c171c0e07fd4',
            'name' => 'Operator Bagian Umum',
            'role' => 'operator',
            'email' => 'bagianumum@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => '9fa0d45a-d220-471b-886f-8238d4334dd7',
            'name' => 'I Kadek Naryasa, S.Kom',
            'role' => 'operator',
            'email' => 'iknproject1125@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => 'fba44d17-6810-4163-abc1-2ffd9d7510d2',
            'name' => 'Kepala Badan',
            'role' => 'kepala_badan',
            'email' => 'kaban@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => '3e2641ff-7eee-4653-bfc8-d94202f5b070',
            'name' => 'Admin Arsika',
            'role' => 'admin',
            'email' => 'arsika@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);

        $this->call([
            GoogleAccessTokenSeeder::class,
        ]);
    }
}
