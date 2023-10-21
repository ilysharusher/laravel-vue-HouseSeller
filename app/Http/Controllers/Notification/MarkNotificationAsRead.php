<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class MarkNotificationAsRead extends Controller
{
    public function __invoke(DatabaseNotification $notification): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', $notification);

        $notification->markAsRead();

        return redirect()->back()
            ->with('success', 'Notification marked as read successfully');
    }
}
