<?php

namespace App\Observers;

use App\Models\User;
use App\Services\FlashMessageService;

class UserObserver
{
    public function __construct(
        public FlashMessageService $flashMessageService
    ) {
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->flashMessageService->success('You have been registered. Please check your email for verification.');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
