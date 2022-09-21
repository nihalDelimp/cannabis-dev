<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Middleware\StartSession;
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
            
      if($user = Auth::user()){
        
        //dd("admin role-",$user);
      }
      // else{
        
      //   return redirect(route('admin',app()->getLocale()));
      // }
      return $next($request);
    }
}
