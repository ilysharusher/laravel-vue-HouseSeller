<?php

namespace App\Broadcasting;

use App\Models\Chat;
use App\Models\User;

class StoreMessage
{
    public function __construct()
    {
        //
    }

    public function join(User $user, Chat $chat): bool
    {
        return auth()->check() &&
            auth()->id() === $user->id &&
            $chat->users()->where('users.id', $user->id)->exists();
    }
}
