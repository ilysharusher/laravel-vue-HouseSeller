<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\Offer;
use App\Models\User;

class makeOfferPolicy
{
    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Offer $offer): bool
    {
        //
    }

    public function create(User $user, Listing $listing): bool
    {
        return $user->id !== $listing->user_id && $listing->sold_at === null;
    }

    public function update(User $user, Offer $offer): bool
    {
        //
    }

    public function delete(User $user, Offer $offer): bool
    {
        //
    }

    public function restore(User $user, Offer $offer): bool
    {
        //
    }

    public function forceDelete(User $user, Offer $offer): bool
    {
        //
    }
}
