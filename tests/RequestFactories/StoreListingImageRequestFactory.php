<?php

namespace Tests\RequestFactories;

use Illuminate\Http\UploadedFile;
use Worksome\RequestFactories\RequestFactory;

class StoreListingImageRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'images' => [UploadedFile::fake()->image('image.jpg')]
        ];
    }
}
