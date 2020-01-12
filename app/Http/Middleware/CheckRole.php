<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
      if (! (auth()->check() && auth()->user()->role == $role)) {
      //if (! $request->user()->hasRole($role)){
            //リダイレクト処理
            return redirect('/home');
        }
        
        return $next($request);
    }
}
