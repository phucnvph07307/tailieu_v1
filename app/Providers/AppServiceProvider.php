<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\SoLieuTuyenSinhInterface;
use App\Repositories\SoLieuTuyenSinhRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\BaseRepository::class,
            \App\Repositories\RepositoryInterface::class
        );

        $this->app->bind(SoLieuTuyenSinhInterface::class, SoLieuTuyenSinhRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
