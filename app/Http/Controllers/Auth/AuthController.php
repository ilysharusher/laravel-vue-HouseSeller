<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function login(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Auth/Login');
    }

    public function register(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Auth/Register');
    }
}
