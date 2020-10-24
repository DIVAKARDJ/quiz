<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserWeb
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
        if (isset(Auth::user()->id) && Auth::user()->role == USER_ROLE_USER && Auth::user()->active_status == STATUS_SUCCESS) {
            if (Auth::user()->email_verified == STATUS_ACTIVE) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('login')->with('dismiss', __('Please verify your email'));
            }

        } else {
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
