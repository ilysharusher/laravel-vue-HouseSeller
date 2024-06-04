<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\UpdatePasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function password_request(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Auth/ForgotPassword');
    }

    public function password_email(ForgotPasswordRequest $request): \Illuminate\Http\RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->validated()
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('login')->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function password_reset(string $token): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Auth/ResetPassword', [
            'token' => $token
        ]);
    }

    public function password_update(
        UpdatePasswordRequest $request,
        UpdatePasswordAction $action
    ): \Illuminate\Http\RedirectResponse {
        $status = $action($request);

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
