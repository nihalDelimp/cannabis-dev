<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminRole
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
      if(auth::user()){

      }
      else{
        return redirect(route('admin',app()->getLocale()));
      }
      return $next($request);
    }
}
