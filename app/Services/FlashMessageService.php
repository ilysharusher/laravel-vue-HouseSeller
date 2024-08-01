<?php

namespace App\Services;

class FlashMessageService
{
    public function success(string $success): void
    {
        session()->flash('success', $success);
    }

    public function failure(string $unsuccess): void
    {
        session()->flash('unsuccess', $unsuccess);
    }
}
