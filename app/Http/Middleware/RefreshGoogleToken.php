<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class RefreshGoogleToken
{
    public function handle($request, Closure $next)
    {
        if (!Cache::has('google_token_checked') || Cache::get('google_token_checked') < now()->subMinutes(50)) {
            $this->refreshTokenIfNeeded();
            Cache::put('google_token_checked', now(), now()->addMinutes(50));
        }

        return $next($request);
    }

    private function refreshTokenIfNeeded()
    {
        // Logic refresh token
    }
}
