<?php

namespace App\Providers;

use App\Domains\UserRole\Models\User;
use App\Domains\UserRole\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        User::observe(UserObserver::class);
    }

    public function register() {}
}
