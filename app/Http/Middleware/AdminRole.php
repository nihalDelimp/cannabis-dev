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
            
      // if($user = Auth::user()){
        
      //   //dd("admin role-",$user);
      // }
      // else{
        
      //   return redirect(route('admin',app()->getLocale()));
      // }

     // $response = $next($request);
        
      // echo "<pre>"; 
      // echo print_r(Auth::user());
      //dd(auth()->guard('api')->user());
      if (Auth::user()) {
          return $next($request);
      }
      else {
         
            $user = JWTAuth::parseToken()->authenticate();
              
          
            if($user && $user->role != 1) {
              return response()->json(['status' => 'Authorization Token not found']);
            } 
            
            return $next($request);
         
        
      }

        // if(!$user = Auth::user()) {
        //     return redirect()->route('admin');
        // }

        // if($user->role != 1 ) {
        //     return redirect('/');
        // }

        // return $response;
        //$user = JWTAuth::toUser($request->header('token'));
        //json_decode((string) $response->getBody(), true)['access_token'];
      //   $user = JWTAuth::parseToken()->authenticate();
      //   dd($user);
      // echo json_encode((string) $request->header('Authorization'));
      // exit;sudhanshu@delimp
      
    }
}
