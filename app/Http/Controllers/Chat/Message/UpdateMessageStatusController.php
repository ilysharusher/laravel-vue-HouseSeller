<?php

namespace App\Http\Controllers\Chat\Message;

use App\Events\MessageReadEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStatus\UpdateMessageStatusRequest;
use App\Models\MessageStatus;

class UpdateMessageStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateMessageStatusRequest $request): void
    {
        MessageStatus::query()->where($request->only(['user_id', 'message_id']))
            ->update(['is_read' => true]);

        broadcast(
            new MessageReadEvent(
                $request->validated()['chat_id'],
                $request->validated()['message_id'],
            )
        )->toOthers();
    }
}
