<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        $data['user'] = Auth::user();
        if ($data['user']->rol_name != 'user'){
            return redirect('dashboard');
        }else{
            return $next($request);
        }
    }
}
