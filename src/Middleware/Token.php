<?php

namespace Yjtec\Rbac\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Token
{
    public function handle($request, Closure $next)
    {   
        //dd(Auth::guard('rbac')->user());
        
        if(Auth::guard('rbac')->guest()){
            return response()->json(['errcode'=> '401','errmsg' => 'token验证失败'],433);
        }

        return $next($request);
    }
}
