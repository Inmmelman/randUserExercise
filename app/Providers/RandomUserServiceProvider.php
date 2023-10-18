<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RandomUserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            'App\Contracts\UserRepositoryInterface',
            'App\Repositories\ApiUserRepository'
        );
    }
}
