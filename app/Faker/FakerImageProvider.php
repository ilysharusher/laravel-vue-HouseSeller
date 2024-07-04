<?php

namespace App\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;

class FakerImageProvider extends Base
{
    public function randomImage(
        string $dir = '',
        int $width = 640,
        int $height = 480,
        string $category = null,
    ): string {
        $name = $dir . '/' . $this->generator->uuid . '.jpg';

        Storage::put(
            $name,
            file_get_contents(
                'https://loremflickr.com/' . $width . '/' . $height . '/' . $category ?? ''
            )
        );

        return $name;
    }
}
