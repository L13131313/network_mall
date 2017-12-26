<?php

namespace App\Http\Middleware;

use Closure;

class Shops
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
        if(session('indexUser')['status'] == 1) {
            return $next($request);
        }   else {
            return back()->with('message', '您不是卖家，请先申请卖家账号！');
        }
    }
}
