<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        if (Auth::user() && Auth::user()->level == 'مدیر')
        {
            return $next($request);
        } else
        {
            return redirect('/admin')->with('error','شما اجازه دسترسی به این بخش را ندارید');
        }

    }
}
