<?php

namespace App\Http\Middleware\Admin;

use Closure;

class admin
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
        if(session('user')) {
            return $next($request);
        }   else {
            return redirect('admin/login')->with('msg','请注意素质');
        }
    }
}
