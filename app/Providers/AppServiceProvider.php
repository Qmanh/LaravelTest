<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            \App\Repositories\Interface\PostRespositoryInterface::class,
                    \App\Repositories\Repository\PostRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interface\ProductRepositoryInterface::class,
            \App\Repositories\Repository\ProductRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interface\ProductCategoryRepositoryInterface::class,
            \App\Repositories\Repository\ProductCategoryRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Interface\PostCategoryRepositoryInterface::class,
            \App\Repositories\Repository\PostCategoryRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interface\UserRepositoryInterface::class,
            \App\Repositories\Repository\UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
