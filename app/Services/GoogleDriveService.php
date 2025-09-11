<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use App\Models\GoogleAccessToken;

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
        $dbToken = GoogleAccessToken::first();

        if ($dbToken) {
            $this->client->setAccessToken(['access_token' => $dbToken->access_token]);

            if ($this->client->isAccessTokenExpired()) {
                $newToken = $this->client->fetchAccessTokenWithRefreshToken(
                    config('filesystems.disks.google.refreshToken')
                );

                if (isset($newToken['access_token'])) {
                    $dbToken->update([
                        'access_token' => $newToken['access_token'],
                        'expires_at'   => now()->addSeconds($newToken['expires_in'] ?? 3600),
                    ]);

                    return $newToken['access_token'];
                }
            }

            return $dbToken->access_token;
        }

        return config('filesystems.disks.google.accessToken');
    }
}
