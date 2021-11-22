<?php

declare(strict_types=1);

namespace App\Providers;

use Domain\Users\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view', function (User $user, $model) {
            return $user->can('view_' . $model) || $user->can('edit_' . $model);
        });

        Gate::define('edit', function (User $user, $model) {
            return $user->can('edit_' . $model);
        });

        Password::defaults(function () {
            $password = Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols();

            return app()->isProduction() ? $password->uncompromised() : $password;
        });
    }
}
