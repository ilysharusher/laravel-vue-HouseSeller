<?php

namespace App\Broadcasting;

use App\Models\User;

class StoreMessageStatus
{
    public function __construct()
    {
        //
    }

    public function join(User $user, int $id): bool
    {
        return auth()->check() && $user->id === $id;
    }
}
