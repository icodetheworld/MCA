<?php

namespace App\Http\Middleware;

use Closure;

class checkParent
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
            return redirect('/login');  
        }
        else if($request->user()->role== 'parent'){
            return $next($request);
        }
        else{
            return redirect('/login');
        }
    }
}
