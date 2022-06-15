<?php

namespace App\Events;

use App\Domains\UserRole\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserPrePersistEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * __construct
     *
     * @param  User $user
     * @return void
     */
    public function __construct(User $user) {
        $this->user = $user;
    }
    
    /**
     * broadcastOn
     * @return void
     */
    public function broadcastOn() {
        return new PrivateChannel('channel-name');
    }
}
