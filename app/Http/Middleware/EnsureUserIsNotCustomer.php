<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureUserIsNotCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info('EnsureUserIsNotCustomer middleware called.');

        if (Auth::check() && Auth::user()->customer) {
            Log::info('User is a customer. Redirecting to /home.');
            return redirect('/')->with('error', 'Access denied.');
        }

        Log::info('User is not a customer. Proceeding to next middleware.');
        return $next($request);
    }
}
