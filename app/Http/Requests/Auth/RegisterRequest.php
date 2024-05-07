<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Tests\RequestFactories\RegisterRequestFactory;

class RegisterRequest extends FormRequest
{
    public static string $factory = RegisterRequestFactory::class;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'password' => ['required', Password::default(), 'confirmed'],
        ];
    }
}
