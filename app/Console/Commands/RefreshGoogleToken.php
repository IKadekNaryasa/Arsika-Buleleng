<?php

namespace App\Console\Commands;

use Google\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RefreshGoogleToken extends Command
{
    protected $signature = 'google:refresh-token';
    protected $description = 'Refresh Google Drive access token';
    public function handle()
    {
        $client = new Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));

        $refreshToken = env('GOOGLE_DRIVE_REFRESH_TOKEN');

        try {
            $newToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);

            if (isset($newToken['access_token'])) {
                DB::table('google_access_tokens')->updateOrInsert(
                    ['id' => 1],
                    [
                        'access_token' => $newToken['access_token'],
                        'expires_at'   => now()->addSeconds($newToken['expires_in'] ?? 3600),
                        'updated_at'   => now(),
                    ]
                );

                $this->info('✅ Access token refreshed & saved to database!');
                Log::info('Google Drive token refreshed', [
                    'time'        => now()->toDateTimeString(),
                    'accessToken' => substr($newToken['access_token'], 0, 20) . '...',
                    'expires_in'  => $newToken['expires_in'] ?? 3600,
                ]);
            } else {
                $this->error('❌ Failed to refresh token');
                Log::error('Google Drive token refresh failed', [
                    'time'  => now()->toDateTimeString(),
                    'error' => $newToken,
                ]);
            }
        } catch (\Exception $e) {
            $this->error('❌ Exception: ' . $e->getMessage());
            Log::error('Google Drive token refresh exception', [
                'time'    => now()->toDateTimeString(),
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
        }
    }
}
