<?php

namespace App\Http\Controllers\Chat;

use App\Actions\Chat\StoreChatAction;
use App\Http\Controllers\Chat\Message\LoadMessagesController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\User\UserResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Chat::class, 'chat');
    }

    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $chats = auth()->user()->getIndexChats();

        return inertia('Chat/Index', [
            'chats' => ChatResource::collection($chats)->resolve(),
        ]);
    }

    public function store(User $user, StoreRequest $request, StoreChatAction $action): \Illuminate\Http\RedirectResponse
    {
        $chat = $action($request);

        return redirect()->route('chats.show', $chat->id);
    }

    public function show(Chat $chat): \Inertia\Response|\Inertia\ResponseFactory
    {
        $chat->readMessages();

        $messages = App::call(LoadMessagesController::class, compact('chat'))->getData();

        return inertia('Chat/Show', [
            'chat' => ChatResource::make($chat)->resolve(),
            'users' => UserResource::collection($chat->users()->get())->resolve(),
            'messages' => $messages->messages,
            'isLastPage' => $messages->is_last_page,
        ]);
    }

    public function destroy_all(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->chats()->delete();

        return back()->with('success', 'All chats have been deleted.');
    }
}
