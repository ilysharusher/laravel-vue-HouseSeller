<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        auth()->login(
            User::query()->create($request->validated())
        );

        return redirect()
            ->route('listing.index')
            ->with('success', 'You have been registered.');
    }
}
