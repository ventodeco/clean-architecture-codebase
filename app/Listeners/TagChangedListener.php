<?php

namespace App\Listeners;

use App\Events\TagCreatedOrUpdatedEvent;

class TagChangedListener
{
    // php artisan make:listener TagChangedListener
    // triggered from Tag::$dispatchEvents

    public function __construct() {}

    public function handle(TagCreatedOrUpdatedEvent $event) {
        $event->tag->slug = str_slug($event->tag->name);
    }
}
