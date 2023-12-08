<?php

namespace App\Providers;

use App\Services\Interfaces\MusicLibraryInterface;
use App\Services\LastFMService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MusicLibraryInterface::class, LastFMService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
