<?php

namespace App\Providers;

use App\Repositories\AdminRepository;
use App\Repositories\Implement\AdminRepositoryImplement;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminRepository::class, function(Application $app){
            return $app->make(AdminRepositoryImplement::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
