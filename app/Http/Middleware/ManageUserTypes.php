<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageUserTypes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->isBuilderLoggedIn() || Auth::user()->isSuperAdminLoggedIn() || Auth::user()->isAdminLoggedIn()) {
                return $next($request);
            } else {
                return redirect('/admin-forbidden');
            }
        } else {
            // return redirect()->route('admin.login')->compact('message', 'Session is expired.');
            return redirect()->route('admin.login');
        }
    }
}
