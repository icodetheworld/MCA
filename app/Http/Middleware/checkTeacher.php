<?php

namespace App\Http\Middleware;

use Closure;

class checkTeacher
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
        else if($request->user()->role== 'teacher'){
            return $next($request);
        }
        else{
            return redirect('/login');
        }
    }
}
