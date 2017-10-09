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
        if ($data['user']->user_rol_name != 'users'){
            return redirect('dashboard');
        }else{
            return $next($request);
        }
    }
}
