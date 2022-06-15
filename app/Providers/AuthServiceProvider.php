<?php

namespace App\Providers;

use App\Domains\Comment\Models\Comment;
use App\Policies\CommentsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Comment::class => CommentsPolicy::class
    ];

    /**
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::resource('comments', 'App\Policies\CommentsPolicy');
    }
}
