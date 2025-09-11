<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GoogleAccessToken;

class CheckGoogleToken extends Command
{
    protected $signature = 'google:check-token';
    protected $description = 'Cek Google Drive access token terakhir di database';

    public function handle()
    {
        $token = GoogleAccessToken::first();

        if (!$token) {
            $this->error('❌ Belum ada Google access token di database.');
            return;
        }

        $this->info("✅ Google Access Token ditemukan:");
        $this->line("Token (30 karakter awal): " . substr($token->access_token, 0, 30) . '...');
        $this->line("Expires At: " . ($token->expires_at ?? 'tidak ada'));
        $this->line("Updated At: " . $token->updated_at);
    }
}
