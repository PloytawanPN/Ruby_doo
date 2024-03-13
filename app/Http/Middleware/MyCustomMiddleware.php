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
            if ($request->path() !== 'signin' && $request->path() !== 'signup') {
                return Redirect::to('signin');
            }
        } elseif (Session::get('role') == 0) {
            if ($request->path() !== 'home') {
                return Redirect::to('home');
            }
        } elseif (Session::get('role') == 1) {
            if ($request->path() === 'home') {
                return Redirect::to('dashboard');
            }
        }else{
            if ($request->path() != 'orderlist') {
                return Redirect::to('orderlist');
            }
        }
        return $next($request);
    }
}
