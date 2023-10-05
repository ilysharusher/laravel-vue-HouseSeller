<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

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
