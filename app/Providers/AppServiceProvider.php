<?php

namespace App\Providers;

use App\Services\AdminService;
use App\Services\Implement\AdminServiceImplement;
use Illuminate\Contracts\Foundation\Application;
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
        $this->app->bind(AdminService::class, function(Application $app){
            return $app->make(AdminServiceImplement::class);
        });
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
