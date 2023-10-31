<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function register(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Auth/Register');
    }

    public function register_store(RegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::query()->create($request->validated());
        auth()->login($user);

        event(new Registered($user));

        return redirect()
            ->route('listing.index')
            ->with('success', 'You have been registered. Please check your email for verification.');
    }
}
