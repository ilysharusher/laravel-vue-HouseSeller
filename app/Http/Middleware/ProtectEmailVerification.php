<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProtectEmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('listing.index')
                ->with('unsuccess', 'Email already verified.');
        }

        return $next($request);
    }
}
