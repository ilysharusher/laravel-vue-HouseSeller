<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'message' => ['required', 'string'],
            'listing_id' => ['required', 'exists:listings,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
