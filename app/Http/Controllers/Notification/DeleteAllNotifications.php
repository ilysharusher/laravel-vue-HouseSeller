<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteAllNotifications extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\RedirectResponse
    {
        request()->user()->notifications()->delete();

        return back()
            ->with('success', 'All notifications have been deleted.');
    }
}
