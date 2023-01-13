<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Middleware\StartSession;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
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
    //   if (Auth::user()) {
    //       return $next($request);
    //   } elseif(!$user = JWTAuth::parseToken()->authenticate()) {
    //     return response()->json(['status' => 'Authorization Token not found']);
    //   } else {
         
    //     $user = JWTAuth::parseToken()->authenticate();
            
        
    //     if($user && $user->role != 1) {
    //         return response()->json(['status' => 'Authorization Token not found']);
    //     } 
        
    //     return $next($request);
         
        
    //   }
        if($user = Auth::user()) {
            if($user->role != 1) {
                return response()->json(['status' => 'Authorization Token not found']);
            }

            return $next($request);
        } else {
            return redirect('/admin');
        }
    }
}
