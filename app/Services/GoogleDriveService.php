<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class GoogleDriveService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(config('filesystems.disks.google.clientId'));
        $this->client->setClientSecret(config('filesystems.disks.google.clientSecret'));
        $this->client->setRedirectUri('urn:ietf:wg:oauth:2.0:oob');
        $this->client->addScope(Drive::DRIVE_FILE);
    }

    public function getValidAccessToken()
    {
        $cachedToken = Cache::get('google_drive_access_token');

        if ($cachedToken && !$this->isTokenExpired($cachedToken)) {
            return $cachedToken;
        }

        // Refresh token
        $this->client->setAccessToken([
            'access_token' => config('filesystems.disks.google.accessToken'),
            'refresh_token' => config('filesystems.disks.google.refreshToken'),
        ]);

        if ($this->client->isAccessTokenExpired()) {
            $this->client->fetchAccessTokenWithRefreshToken(config('filesystems.disks.google.refreshToken'));
            $newToken = $this->client->getAccessToken();

            Cache::put('google_drive_access_token', $newToken['access_token'], now()->addMinutes(55));

            return $newToken['access_token'];
        }

        return config('filesystems.disks.google.accessToken');
    }

    private function isTokenExpired($token)
    {
        return false;
    }
}
