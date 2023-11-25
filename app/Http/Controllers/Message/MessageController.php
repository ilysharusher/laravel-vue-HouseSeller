<?php

namespace App\Http\Controllers\Message;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageFormRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Message/Index');
    }

    public function messages(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Message::with('user')->get();
    }

    public function send(MessageFormRequest $request): Message
    {
        $message = $request->user()->messages()->create($request->validated());

        broadcast(new MessageSent($request->user(), $message));

        return $message;
    }
}
