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
            'bidang_id' => '131695ba-ff79-4c31-a492-8fb99b672f65',
            'name' => 'I Kadek Naryasa, S.Kom',
            'role' => 'operator',
            'email' => 'qy.naryasa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
    }
}
