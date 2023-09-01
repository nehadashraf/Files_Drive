<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role == 'super admin') {
            return $next($request);
        } else {
            return redirect()->route('user.notAuthorized');
        }
    }
}
