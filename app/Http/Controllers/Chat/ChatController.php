<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Chat\Message\LoadMessagesController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\User\UserResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Chat::class, 'chat');
    }

    private function getUserIdsAsString(array $user_ids): string
    {
        sort($user_ids);

        return implode('-', $user_ids);
    }

    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $chats = auth()->user()->getIndexChats();

        return inertia('Chat/Index', [
            'chats' => ChatResource::collection($chats)->resolve(),
        ]);
    }

    public function store(User $user, StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user_ids = [(int)$request->validated()['user'], auth()->id()];

        try {
            DB::beginTransaction();

            $chat = Chat::query()->updateOrCreate([
                'users' => $this->getUserIdsAsString($user_ids),
                'listing_id' => (int)$request->validated()['listing_id'],
            ]);

            $chat->users()->sync($user_ids);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error($exception);

            return back()->with('error', $exception->getMessage());
        }

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
}
