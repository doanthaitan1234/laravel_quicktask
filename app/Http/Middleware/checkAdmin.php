<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support;
use App\Defines\Define;
use Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         if (Auth::user() && Auth::user()->isAdmin == Define::ADMIN) {
            if (Auth::user()->isActive == Define::ACTIVE) {
                return $next($request);
            }
            else {
                $message = 'Your account is not actived!';
                return response()->view('auth.login', compact('message'));
            }
        } else {
            if ($request->email && $request->password) {
                $message = 'Login fail!';
                return response()->view('auth.login', compact('message'));
            }
        }
        
        return response()->view('auth.login');
    }
}
