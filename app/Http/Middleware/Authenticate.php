<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    
    public function handle($request, Closure $next)
    {
       
        $token = session()->get('token');
        
        if(!$token)
        {
            return redirect()->guest(url('login'))->with('Warning','Session Expired!');
        }
        return $next($request);
    }
    
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }        
    }
}
