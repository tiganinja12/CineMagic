<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    public function handle(Request $request, Closure $next, ...$types)
    {
        $user = Auth::user();

        if (!in_array($user->type, $types)) {
            return redirect('/home')->with('error', 'You do not have access to this section.');
        }

        return $next($request);
    }
}
