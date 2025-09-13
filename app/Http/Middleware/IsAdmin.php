<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return $next($request);
            }

            if ($role === 'user') {
                return redirect()->route('dashboard')->with('success', 'Login In successfully .');
            }
        }

        return redirect()->route('login')->with('error', 'Access denied!');
    }
}
