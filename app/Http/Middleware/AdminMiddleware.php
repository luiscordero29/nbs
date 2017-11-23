<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $data['user'] = User::where('user_uid', $data['user']->user_uid)->first();
        if ($data['user']->role->role_name != 'admin'){
            return redirect('dashboard');
        }else{
            return $next($request);
        }
    }
}
