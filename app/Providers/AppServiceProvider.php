<?php

namespace App\Providers;

use App\Repositories\UrlEloquentRepository;
use App\Repositories\UrlRepository;
use App\Services\ShortUrlService;
use App\Services\ShortUrlTinyurlService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ShortUrlService::class, ShortUrlTinyurlService::class);
        $this->app->bind(UrlRepository::class, UrlEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
