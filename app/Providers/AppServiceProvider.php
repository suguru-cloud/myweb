<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//追記
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        //以下を追記
        //if (\App::environment('production')) {
            \URL::forceScheme('https');
        //}
        
    }
}
