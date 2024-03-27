<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class TriggerNotificationEvent implements ShouldBroadcast
{
    use Dispatchable;

    public function __construct(public string $message)
    {
    }

    public function broadcastOn(): array
    {
        return [
            // This will broadcast the event without any authentication
            new Channel('notification')
        ];
    }
}
