<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Listing $listing): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Listing $listing): bool
    {
        return true;
    }

    public function delete(User $user, Listing $listing): bool
    {
        return true;
    }

    public function restore(User $user, Listing $listing): bool
    {
        return true;
    }

    public function forceDelete(User $user, Listing $listing): bool
    {
        return true;
    }
}
