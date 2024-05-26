<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;

class ChatPolicy
{
    public function viewAny(User $user): bool
    {
        return auth()->check();
    }

    public function view(User $user, Chat $chat): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        $userIdFromRequest = request()->input('user');

        return $user->id !== $userIdFromRequest;
    }

    /*public function update(User $user, Chat $chat): bool
    {
        //
    }

    public function delete(User $user, Chat $chat): bool
    {
        //
    }

    public function restore(User $user, Chat $chat): bool
    {
        //
    }

    public function forceDelete(User $user, Chat $chat): bool
    {
        //
    }*/
}
