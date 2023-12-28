<?php

namespace App\Http\Requests\MessageStatus;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'message_id' => ['required', 'integer', 'exists:messages,id'],
        ];
    }
}
