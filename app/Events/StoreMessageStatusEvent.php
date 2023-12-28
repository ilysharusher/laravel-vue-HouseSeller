<?php

namespace App\Events;

use App\Http\Resources\Message\MessageResource;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreMessageStatusEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        private readonly int $chatId,
        private readonly int $count,
        private readonly int $interlocutorId,
        private readonly \App\Models\Message $message,
    ) {
        //
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('store-message-status-event-' . $this->interlocutorId . '-user'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'store-message-status-event';
    }

    public function broadcastWith(): array
    {
        return [
            'chat_id' => $this->chatId,
            'count' => $this->count,
            'message' => MessageResource::make($this->message)->resolve(),
        ];
    }
}
