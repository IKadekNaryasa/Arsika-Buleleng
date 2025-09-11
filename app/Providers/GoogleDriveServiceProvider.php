<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GoogleDriveServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('google', function ($app, $config) {
            $accessToken = DB::table('google_access_tokens')->value('access_token');

            $options = [
                'clientId'     => $config['clientId'],
                'clientSecret' => $config['clientSecret'],
                'refreshToken' => $config['refreshToken'],
                'accessToken'  => $accessToken,
                'folderId'     => $config['folderId'],
            ];

            return new \Masbug\Flysystem\GoogleDriveAdapter($options);
        });
    }
}
