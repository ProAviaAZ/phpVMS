<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('access_admin', function (?User $user): Response {
            return $user?->ability('admin', 'admin-access')
            ? Response::allow()
            : Response::deny('You do not have permission to access this page.');
        });

        Gate::define('viewLogViewer', function (?User $user): Response {
            return $user?->ability('admin', 'logs')
                ? Response::allow()
                : Response::deny('You do not have permission to access this page.');
        });
    }
}
