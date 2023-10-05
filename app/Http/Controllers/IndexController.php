<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        // dd(Auth::user());

        return inertia(
            'Index/Index',
            [
                'message' => 'Hello from Laravel!',
            ]
        );
    }

    public function show(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Index/Show');
    }
}
