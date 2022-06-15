<?php

namespace App\Providers;

use App\Events\TagCreatedOrUpdatedEvent;
use App\Listeners\TagChangedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],

        TagCreatedOrUpdatedEvent::class =>
            [TagChangedListener::class]
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
