<?php

namespace App\Http\Controllers\Auth\VerifyEmail;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationProcess extends Controller
{
    public function __invoke(EmailVerificationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->fulfill();

        return redirect()->route('listing.index')
            ->with('success', 'Email verified!');
    }
}
