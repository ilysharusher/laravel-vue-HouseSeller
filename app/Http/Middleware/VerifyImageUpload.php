<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyImageUpload
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->hasFile('images');

        return $next($request);
    }
}
