<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class isUser
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
        if (Auth::user()->level_id == 3) {
            return $next($request);
        }elseif (Auth::user()->level_id == 2) {
            return $next($request);
        }elseif (Auth::user()->level_id == 1) {
            return $next($request);
        }else {
            return redirect('/');
        } 
            
        
    }
}
