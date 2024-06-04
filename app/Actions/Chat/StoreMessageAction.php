<?php

namespace App\Actions\Chat;

use App\Events\StoreMessageEvent;
use App\Http\Requests\Message\StoreRequest;
use App\Jobs\StoreMessageStatusJob;
use App\Models\Message;

class StoreMessageAction
{
    public function __invoke(StoreRequest $request): Message
    {
        $validatedData = $request->validated();
        $chatId = $validatedData['chat_id'];

        $message = Message::query()->create([
            'chat_id' => $chatId,
            'user_id' => $request->user()->id,
            'text' => $validatedData['text'],
        ]);

        StoreMessageStatusJob::dispatch($validatedData, $chatId, $message)
            ->onQueue('store_message_status');

        broadcast(new StoreMessageEvent($message))->toOthers();

        return $message;
    }
}
