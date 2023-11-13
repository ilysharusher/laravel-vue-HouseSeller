<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class ListingPolicy
{
    public function before(?User $user, string $ability): ?bool
    {
        if ($user?->is_admin) {
            return true;
        }

        return null;
    }

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Listing $listing): bool
    {
        return ($listing->sold_at === null) || ($listing->user_id === $user?->id);
    }

    public function viewRealtor(?User $user, Listing $listing): bool
    {
        return $listing->user_id === $user?->id;
    }

    public function create(User $user): bool
    {
        return auth()->check();
    }

    public function update(User $user, Listing $listing): bool
    {
        return $listing->sold_at === null && $user->id === $listing->user_id;
    }

    public function delete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->user_id;
    }

    public function restore(User $user, Listing $listing): bool
    {
        return $user->id === $listing->user_id;
    }

    public function forceDelete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->user_id;
    }
}
