<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UpdatePasswordAction
{
    public function __invoke(UpdatePasswordRequest $request)
    {
        return Password::reset(
            $request->validated(),
            static function (User $user, string $password) {
                $user->setRememberToken(Str::random(60));
                $user->password = $password;

                $user->save();

                event(new PasswordReset($user));
            }
        );
    }
}
