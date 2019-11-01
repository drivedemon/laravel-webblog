<?php

namespace App\Http\Middleware;

use Closure;

class checkApprove
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
      if (auth()->user()->role_pending == 'noapprove') {
        Session()->flash('error', 'ไม่มีสิทธิ์การเข้าถึง');
        return back();
      }
        return $next($request);
    }
}
