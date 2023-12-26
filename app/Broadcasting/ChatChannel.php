<?php

namespace App\Broadcasting;

use App\Models\Listing;
use App\Models\User;

class ChatChannel
{
    public function __construct()
    {
        //
    }

    public function join(User $user, Listing $listing): array|bool
    {
        return auth()->check() && ($user->is($listing->user) || $listing->offers()->where(
            'bidder_id',
            $user->id
        )->exists());
    }
}
