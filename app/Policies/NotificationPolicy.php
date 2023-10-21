<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy
{
    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, DatabaseNotification $databaseNotification): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, DatabaseNotification $databaseNotification): bool
    {
        return $user->id === $databaseNotification->notifiable_id;
    }

    public function delete(User $user, DatabaseNotification $databaseNotification): bool
    {
        //
    }

    public function restore(User $user, DatabaseNotification $databaseNotification): bool
    {
        //
    }

    public function forceDelete(User $user, DatabaseNotification $databaseNotification): bool
    {
        //
    }
}
