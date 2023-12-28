<?php

namespace App\Http\Controllers\Message;

use App\Events\StoreMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Jobs\StoreMessageStatusJob;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(StoreRequest $request): \Illuminate\Http\JsonResponse|array
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

        return MessageResource::make($message)->resolve();
    }
}
