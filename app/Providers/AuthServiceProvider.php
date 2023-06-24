<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\OrderLogPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use App\Repositories\Orders\Order;
use App\Repositories\Orders\OrderLog;
use App\Repositories\Products\Product;
use App\Repositories\Users\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        OrderLog::class => OrderLogPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();


        Gate::define('create', [UserPolicy::class, 'create']);
//        Gate::define('show', [UserPolicy::class, 'show']);
//        Gate::define('update', [UserPolicy::class, 'update']);
//        Gate::define('delete', [UserPolicy::class, 'delete']);

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
