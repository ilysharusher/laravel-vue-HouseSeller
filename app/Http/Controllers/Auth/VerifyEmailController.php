<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verification_notice(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Auth/VerifyEmail');
    }

    public function send_verification_email(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();

        dispatch(function () use ($user) {
            $user->sendEmailVerificationNotification();
        });

        return back()->with(
            'success',
            'Verification link sent!'
        );
    }

    public function verification_process(EmailVerificationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->fulfill();

        return redirect()->route('listing.index')
            ->with('success', 'Email verified!');
    }
}
