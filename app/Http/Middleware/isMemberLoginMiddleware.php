<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class isMemberLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($rq, Closure $next)
    {
        if(Auth::attempt(['email'=>$rq->email,'password'=>$rq->password,'role'=>0])){
            return redirect()->route('home');
        }
        return $next($rq);
    }
}
