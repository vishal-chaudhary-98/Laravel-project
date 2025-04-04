<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if ($request->is('admin/login') || $request->is('admin/*')) {
        //     if (Auth::guard('admin')->check()) {
        //         return redirect('/admin ');
        //     }
        // } elseif ($request->is('/login') || $request->is('/register')) {
        //     if (Auth::guard('user')->check()) {
        //         return redirect('/dashboard');
        //     }
        // }

        // If user is logged in as admin
    if (Auth::guard('admin')->check()) {
        // Prevent access to user login/register pages
        if ($request->is('user/login') || $request->is('user/register')) {
            return redirect('/ad');
        }
    }

    // If user is logged in as regular user
    if (Auth::guard('web')->check()) {
        // Prevent access to admin routes
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect('/user/login');
        }
    }


        return $next($request);
    }
}
