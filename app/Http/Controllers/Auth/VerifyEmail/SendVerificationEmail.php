<?php

namespace App\Http\Controllers\Auth\VerifyEmail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendVerificationEmail extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with(
            'success',
            'Verification link sent!'
        );
    }
}
