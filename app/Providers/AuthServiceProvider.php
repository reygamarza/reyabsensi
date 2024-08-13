<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Gate::define('operator', function (User $user) {
            return $user->role == 'operator';
        });

        Gate::define('kesiswaan', function (User $user) {
            return $user->role == 'kesiswaan';
        });

        Gate::define('siswa', function (User $user) {
            return $user->role == 'siswa';
        });

        Gate::define('wali', function (User $user) {
            return $user->role == 'wali';
        });

        Gate::define('walis', function (User $user) {
            return $user->role == 'walis';
        });
    }
}
