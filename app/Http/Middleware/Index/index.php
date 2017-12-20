<?php

namespace App\Http\Middleware\Index;

use Closure;

class index
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
        if(session('indexUser')) {
            return $next($request);
        }   else {
            return redirect('index/login');
        }
    }
}
