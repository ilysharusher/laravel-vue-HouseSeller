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
            'images.*' => ['image', 'mimes:jpg,jpeg,png', 'max:10240'],
        ];
    }
}
