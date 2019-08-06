<?php

namespace Yjtec\Rbac\Middleware;

use Closure;

class Rbac
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

        $action = $request->route()->getActionName();
        list($class,$method) = explode('@', $action);

        $module = str_replace('Controller','',substr(strrchr($class,'\\'),1));
        
        dd($method);

        return $next($request);
    }
}
