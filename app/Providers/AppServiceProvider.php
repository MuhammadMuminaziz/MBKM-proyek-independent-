<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Gate::define('profile', function (User $user) {
            return $user->type === 'Profile' || $user->type === 'Administrator';
        });
        Gate::define('rekam_medis', function (User $user) {
            return $user->type === 'Rekam Medis' || $user->type === 'Administrator';
        });
        Gate::define('rawat_jalan', function (User $user) {
            return $user->type === 'Rawat Jalan' || $user->type === 'Administrator';
        });
        Gate::define('rawat_inap', function (User $user) {
            return $user->type === 'Rawat Inap' || $user->type === 'Administrator';
        });
        Gate::define('admin', function (User $user) {
            return $user->type === 'Administrator';
        });
    }
}
