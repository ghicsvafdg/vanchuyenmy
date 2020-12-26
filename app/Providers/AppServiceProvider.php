<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.bootstrap-4');
        // if (env('REDIRECT_HTTPS')){
        //     $url->forceSchema('https');
        // }
    }
    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        // if(env('REDIRECT_HTTPS')){
        //     $this->app['request']->server->set('HTTPS',true);
        // }
    }
    
}
