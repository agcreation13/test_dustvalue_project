<?php
// Path: app/Providers/AuthServiceProvider.php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define Gates for roles
        Gate::define('isAdmin', function (User $user) {
            return $user->role === User::ROLE_ADMIN;
        });

        Gate::define('isManager', function (User $user) {
            return $user->role === User::ROLE_MANAGER;
        });

        Gate::define('isEmployee', function (User $user) {
            return $user->role === User::ROLE_EMPLOYEE;
        });

        // Example: Allow both Admin and Manager to manage employees
        Gate::define('manageEmployees', function (User $user) {
            return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_MANAGER]);
        });

        // Allow only Admin to generate reports
        Gate::define('generateReports', function (User $user) {
            return $user->role === User::ROLE_ADMIN;
        });
    }
}