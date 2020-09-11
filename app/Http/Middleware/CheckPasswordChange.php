<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckPasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->change_password) {
            \Alert::warning('Alert!', 'A password change is required');

            return redirect(route('settings.edit'));
        }

        return $next($request);
    }
}
