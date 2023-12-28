<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\LoadMessageRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Chat;

class LoadMessagesController extends Controller
{
    public function __invoke(LoadMessageRequest $request, Chat $chat = null): \Illuminate\Http\JsonResponse
    {
        $requestValidated = $request->validated();
        $chat = $chat ?? Chat::query()->findOrFail($requestValidated['chat_id']);

        $messages = $chat->paginateMessages($requestValidated['page'] ?? null);

        return response()->json([
            'messages' => MessageResource::collection($messages)->resolve(),
            'is_last_page' => $messages->onLastPage(),
        ]);
    }
}
