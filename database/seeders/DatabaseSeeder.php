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
            'bidang_id' => 'dd048bbe-1a66-43c7-aaa9-00e39e1febbd',
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
