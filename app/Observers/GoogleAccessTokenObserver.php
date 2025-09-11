<?php

namespace App\Observers;

use App\Models\GoogleAccessToken;
use Illuminate\Support\Facades\Log;

class GoogleAccessTokenObserver
{
    /**
     * Handle the GoogleAccessToken "updated" event.
     */
    public function updated(GoogleAccessToken $googleAccessToken): void
    {
        Log::info('Google Access Token diperbarui', [
            'token'      => substr($googleAccessToken->access_token, 0, 10) . '...',
            'expires_at' => $googleAccessToken->expires_at,
            'updated_at' => $googleAccessToken->updated_at,
        ]);
    }

    /**
     * Handle the GoogleAccessToken "created" event.
     */
    public function created(GoogleAccessToken $googleAccessToken): void
    {
        Log::info('Google Access Token dibuat pertama kali', [
            'token'      => substr($googleAccessToken->access_token, 0, 10) . '...',
            'expires_at' => $googleAccessToken->expires_at,
        ]);
    }
}
