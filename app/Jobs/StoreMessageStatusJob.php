<?php

namespace App\Jobs;

use App\Events\StoreMessageStatusEvent;
use App\Models\Message;
use App\Models\MessageStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreMessageStatusJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly array $validatedData,
        private readonly int $chatId,
        private readonly Message $message,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        MessageStatus::query()->create([
            'chat_id' => $this->chatId,
            'message_id' => $this->message->id,
            'user_id' => $this->validatedData['interlocutor'],
        ]);

        $count = MessageStatus::query()
            ->where('chat_id', $this->chatId)
            ->where('user_id', $this->validatedData['interlocutor'])
            ->where('is_read', false)
            ->count();

        broadcast(new StoreMessageStatusEvent($this->chatId, $count, $this->validatedData['interlocutor'], $this->message));
    }
}
