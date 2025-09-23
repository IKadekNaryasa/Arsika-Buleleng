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
            'bidang_id' => '8a0ee2d4-c709-4a03-ab42-0bfd7b344ac6',
            'name' => 'Operator Bidang 1',
            'role' => 'operator',
            'email' => 'bidang1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => 'bbeccf3f-0fa8-4f5d-b0c3-745100ce893c',
            'name' => 'Operator Bidang II',
            'role' => 'operator',
            'email' => 'bidang2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => '4b5e20dc-673d-4c05-b386-1b8f056e1cf1',
            'name' => 'Operator Bagian Umum',
            'role' => 'operator',
            'email' => 'bagianumum@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
        User::create([
            'id' => Str::uuid()->toString(),
            'bidang_id' => '8d84e682-a5e5-4714-87a5-efa6a230e226',
            'name' => 'I Kadek Naryasa, S.Kom',
            'role' => 'operator',
            'email' => 'iknproject1125@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);

        $this->call([
            GoogleAccessTokenSeeder::class,
        ]);
    }
}
