<?php

namespace App\Providers;

use App\Models\GoogleAccessToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use App\Observers\GoogleAccessTokenObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        GoogleAccessToken::observe(GoogleAccessTokenObserver::class);
        GoogleDriveServiceProvider::class;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
