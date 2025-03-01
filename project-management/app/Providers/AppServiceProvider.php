<?php

namespace App\Providers;

use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;
use App\Repositories\Interfaces\Task\TaskRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Task\TaskRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
