<?php

namespace App\Http\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;
use Tests\RequestFactories\StoreListingRequestFactory;

class StoreRequest extends FormRequest
{
    public static string $factory = StoreListingRequestFactory::class;

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'beds' => ['required', 'integer', 'min:1', 'max:300'],
            'baths' => ['required', 'integer', 'min:1', 'max:300'],
            'area' => ['required', 'integer', 'min:1', 'max:50000'],
            'city' => ['required', 'string', 'min:2', 'max:100'],
            'code' => ['required', 'string', 'min:2', 'max:100'],
            'street' => ['required', 'string', 'min:2', 'max:100'],
            'street_number' => ['required', 'string', 'min:1', 'max:100'],
            'price' => ['required', 'integer', 'min:100', 'max:1000000000'],
        ];
    }
}
