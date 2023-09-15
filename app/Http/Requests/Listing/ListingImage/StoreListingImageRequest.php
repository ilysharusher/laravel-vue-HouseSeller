<?php

namespace App\Http\Requests\Listing\ListingImage;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'images' => ['image', 'mimes:jpeg,png,jpg', 'max:5000']
        ];
    }
}
