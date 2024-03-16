<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class MyCustomMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Session::has('username')) {
            if ($request->path() != 'signin' && $request->path() != 'signup') {
                return Redirect::to('signin');
            }
        } else {

            if ($request->path() == 'signin' || $request->path() == 'signup') {
                if (Session::get('role') == 2) {
                    return Redirect::to('orderlist');
                } else {
                    return Redirect::to('dashboard');
                }
            }

            if ($request->path() != 'orderlist' && $request->path() != 'pickstock') {
                if (Session::get('role') == 2) {
                    return Redirect::to('orderlist');
                }
            }
        }

        /* if (!Session::has('username')) {
            if ($request->path() !== 'signin' && $request->path() !== 'signup') {
                return Redirect::to('signin');
            }
        } else {
            if (Session::get('role') == 0) {
                if ($request->path() !== 'orderlist' || $request->path() !== 'pickstock') {
                    return Redirect::to('orderlist');
                }
            }
        } */
        return $next($request);
    }
}
