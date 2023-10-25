<?php

namespace App\Http\Controllers\Auth\VerifyEmail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationNotice extends Controller
{
    public function __invoke(Request $request): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Auth/VerifyEmail');
    }
}
