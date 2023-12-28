<?php

namespace App\Http\Controllers\MessageStatus;

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
    }
}
