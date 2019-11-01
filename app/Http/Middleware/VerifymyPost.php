<?php

namespace App\Http\Middleware;

use Closure;

class VerifymyPost
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
    if (session()->has('flag')) {
      $request->session()->forget(['flag', 'oldid']);
    }
    if (!$request->session()->has('oldid')) {
      $request->session()->push('oldid', $request->route('post.id'));
    }
    if ($request->session()->get('oldid.0') != $request->post->id) {
      Session()->flash('error', 'กรุณาเข้าถึงบทความอย่างถูกวิธี');
      return back();
    }
    return $next($request);
  }
}
