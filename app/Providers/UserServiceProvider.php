<?php
namespace App\Providers;

use App\Contracts\UserRepositoryInterface;
use App\Repositories\ApiUserRepository;
use App\Strategies\LastNameSortStrategy;
use App\Strategies\SortStrategyInterface;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, ApiUserRepository::class);
        $this->app->bind(SortStrategyInterface::class, LastNameSortStrategy::class);
    }
}
