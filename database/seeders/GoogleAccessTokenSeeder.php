<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GoogleAccessToken;

class GoogleAccessTokenSeeder extends Seeder
{
    public function run(): void
    {
        GoogleAccessToken::updateOrCreate(
            ['id' => 1],
            [
                'access_token' => env('GOOGLE_DRIVE_ACCESS_TOKEN', ''),
                'expires_at'   => now()->addHour(),
            ]
        );
    }
}
