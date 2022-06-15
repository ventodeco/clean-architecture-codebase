<?php

namespace App\Events;

use App\Domains\Tag\Models\Tag;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TagCreatedOrUpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * __construct
     *
     * @param  mixed $tag
     * @return void
     */
    public function __construct(Tag $tag) {
        $this->tag = $tag;
    }
    
    /**
     * broadcastOn
     *
     * @return void
     */
    public function broadcastOn() {
        return new PrivateChannel('channel-name');
    }
}
