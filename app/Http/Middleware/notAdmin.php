<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
// use level;

class notAdmin
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
        // $user = \App\User::where('username', $request->email)->first();
        if (Auth::user()->level_id == 1) {
            return $next($request);
        }elseif(Auth::user()->level_id == 2) {
                return $next($request);
        }else {
            # code...
            return redirect('/');
        }

        // elseif(Auth::user()->level_id == 3) {
        //     return $next($request);
        // }elseif (Auth::user()->level_id == 4) {
        //     return $next($request);
        // }

        // return redirect('/');
    }
}
