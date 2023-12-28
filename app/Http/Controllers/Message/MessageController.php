<?php

namespace App\Http\Controllers\Message;

use App\Events\StoreMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageFormRequest;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $bidders = User::query()->whereHas('offers')->get();

        $buyers = User::query()->listings()->get();

        return inertia('Chat/Index');
    }

    public function messages(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Message::with('user')->get();
    }

    public function send(MessageFormRequest $request): Message
    {
        $message = $request->user()->messages()->create($request->validated());

        broadcast(new StoreMessageEvent($request->user_id, $request->listing_id, $message));

        return $message;
    }
}
