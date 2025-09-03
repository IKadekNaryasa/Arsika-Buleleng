<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Client;

class RefreshGoogleToken extends Command
{
    protected $signature = 'google:refresh-token';
    protected $description = 'Refresh Google Drive access token';

    public function handle()
    {
        $client = new Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));

        $newToken = $client->fetchAccessTokenWithRefreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        if (isset($newToken['access_token'])) {
            $this->updateEnvFile('GOOGLE_DRIVE_ACCESS_TOKEN', $newToken['access_token']);
            $this->info('Access token refreshed successfully');
        } else {
            $this->error('Failed to refresh token');
        }
    }

    private function updateEnvFile($key, $value)
    {
        $envFile = base_path('.env');
        $str = file_get_contents($envFile);
        $str = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $str);
        file_put_contents($envFile, $str);
    }
}
