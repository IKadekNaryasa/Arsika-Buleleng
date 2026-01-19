<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Google\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class RefreshGoogleToken extends Command
{
    protected $signature = 'google:refresh-token';
    protected $description = 'Refresh Google Drive access token';

    public function handle()
    {
        $timezone = env('APP_TIMEZONE');

        $client = new Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));

        $refreshToken = env('GOOGLE_DRIVE_REFRESH_TOKEN');

        try {
            $newToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);

            if (isset($newToken['access_token'])) {
                $currentTime = Carbon::now($timezone);
                $expiresAt = Carbon::now($timezone)->addSeconds($newToken['expires_in'] ?? 3600);

                DB::table('google_access_tokens')->updateOrInsert(
                    ['id' => 1],
                    [
                        'access_token' => $newToken['access_token'],
                        'expires_at'   => $expiresAt,
                        'updated_at'   => $currentTime,
                    ]
                );
                $token = $newToken['access_token'];
                $this->info('✅ Access token refreshed & saved to database!');
                $this->info('⏰ Current WITA time: ' . $currentTime->format('Y-m-d H:i:s T'));

                Http::withHeaders([
                    'Authorization' => env('AUTH_FONTE'),
                ])->post('https://api.fonnte.com/send', [
                    'target' => '085171009602',
                    'message' => "Access Token ARSIKA Buleleng Updated! 
                                    \nAccess Token : $token
                                    \nUpdated At : $currentTime
                                    \nExpired At : $expiresAt"
                ]);



                Log::info('Google Drive token refreshed', [
                    'time'        => $currentTime->toDateTimeString(),
                    'timezone'    => $currentTime->getTimezone()->getName(),
                    'accessToken' => substr($newToken['access_token'], 0, 20) . '...',
                    'expires_in'  => $newToken['expires_in'] ?? 3600,
                    'expires_at'  => $expiresAt->toDateTimeString(),
                ]);
            } else {
                $currentTime = Carbon::now('Asia/Makassar');
                $this->error('❌ Failed to refresh token');
                Log::error('Google Drive token refresh failed', [
                    'time'     => $currentTime->toDateTimeString(),
                    'timezone' => $currentTime->getTimezone()->getName(),
                    'error'    => $newToken,
                ]);
            }
        } catch (\Exception $e) {
            $currentTime = Carbon::now('Asia/Makassar');
            $this->error('❌ Exception: ' . $e->getMessage());
            Log::error('Google Drive token refresh exception', [
                'time'     => $currentTime->toDateTimeString(),
                'timezone' => $currentTime->getTimezone()->getName(),
                'message'  => $e->getMessage(),
                'trace'    => $e->getTraceAsString(),
            ]);
        }
    }
}
