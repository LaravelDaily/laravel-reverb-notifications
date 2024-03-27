<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class TriggerPrivateNotificationEvent implements ShouldBroadcast
{
    use Dispatchable;

    public function __construct(public string $message, private User $user)
    {
    }

    public function broadcastOn(): array
    {
        return [
            // This will broadcast to a private channel for the user
            new PrivateChannel('App.Models.User.' . $this->user->id)
        ];
    }
}
