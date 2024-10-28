<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('superadmin')->check() && Auth::guard('superadmin')->user()->id_desausertype == 1) {
            return $next($request);
        }

        if (Auth::guard('adminaplikasi')->check() && in_array(Auth::guard('adminaplikasi')->user()->id_desausertype, [2, 3])) {
            // in_array(Auth::guard('adminaplikasi')->user()->id_desausertype, [2, 3])
            // in_array(4, [2, 3])
            return $next($request);
        }

        if (Auth::guard('operatordesa')->check() && in_array(Auth::guard('operatordesa')->user()->id_desausertype, [2, 3])) {
            return $next($request);
        }

        if (Auth::guard('user')->check() && Auth::guard('user')->user()->id_desausertype == 4) {
            return $next($request);
        }

        return redirect()->route('login')->withErrors('Unauthorized');
    }
}
