<?php

namespace App\Http\Middleware;

use Closure;

class checkStudent
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
        if($request->user()== NULL){
            return redirect('/403');  
        }
        else if($request->user()->role== 'student'){
            return $next($request);
        }
        else{
            return redirect('/404');
        }
    }
}
