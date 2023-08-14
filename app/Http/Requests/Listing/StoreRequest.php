<?php

namespace App\Http\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'beds'          => ['required', 'integer', 'min:1', 'max:300'],
            'baths'         => ['required', 'integer', 'min:1', 'max:300'],
            'area'          => ['required', 'integer', 'min:1', 'max:50000'],
            'city'          => ['required', 'string', 'min:2', 'max:100'],
            'code'          => ['required', 'string', 'min:2', 'max:100'],
            'street'        => ['required', 'string', 'min:2', 'max:100'],
            'street_number' => ['required', 'string', 'min:1', 'max:100'],
            'price'         => ['required', 'integer', 'min:100', 'max:1000000000'],
        ];
    }
}
