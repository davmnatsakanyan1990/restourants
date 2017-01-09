<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                switch ($guard){
                    case 'admin' :
                        return redirect('admin/login');
                    break;
                    case 'super_admin' :
                        return redirect('super_admin/login');
                    break;
                    case 'group_admin' :
                        return redirect('group_admin/login');
                        break;
                }
            }
        }

        return $next($request);
    }
}
