<?php

namespace App\Events;

use App\Models\{Listing, Message, User};
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreMessageEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        private readonly Message $message
    ) {
        //
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('store-message-event-' . $this->message->chat_id . '-chat'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'store-message-event';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message->message
        ];
    }
}
