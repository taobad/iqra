<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;

class CheckRole
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
        if ($request->user() == null){
          //return response ("Insufficient Permissions",401);
          return Redirect::back()->withErrors(['Operation requires a different user role or permission']);
        }
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || !$roles){
            return $next($request);
        }
        //return response ("Insufficient Permissions",401);
        return Redirect::back()->withErrors(['Operation requires a different user role or permission']);
    }
}
