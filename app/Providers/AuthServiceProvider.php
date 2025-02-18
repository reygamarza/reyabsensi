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
        Gate::define('isSiswa', function ($user) {
            return $user->role === 'siswa';
        });

        Gate::define('isOperator', function ($user) {
            return $user->role === 'operator';
        });

        Gate::define('isKesiswaan', function ($user) {
            return $user->role === 'kesiswaan';
        });

        Gate::define('isWaliKelas', function ($user) {
            return $user->role === 'waliKelas';
        });

        Gate::define('isWaliSiswa', function ($user) {
            return $user->role === 'waliSiswa';
        });
    }
}
