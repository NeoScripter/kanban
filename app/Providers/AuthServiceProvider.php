<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Dashboard;
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
        Gate::define('delete-dashboard', function (User $user, Dashboard $dashboard) {
            return $user->id === $dashboard->user_id;
        });

        Gate::define('edit-dashboard', function (User $user, Dashboard $dashboard) {
            return $user->id === $dashboard->user_id;
        });
    }
}
