<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

class AppRepositoryServiceProvider extends AppServiceProvider
{
    /**
     * Register all repositories.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
    }
}