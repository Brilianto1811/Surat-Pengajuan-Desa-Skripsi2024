<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        if (Auth::guard('superadmin')->check() && Auth::guard('superadmin')->user()->id_desausertype == 1) {
            return redirect()->route('jenis-surat.index');
        }

        if (Auth::guard('adminaplikasi')->check() && Auth::guard('adminaplikasi')->user()->id_desausertype == 2) {
            return redirect()->route('dashboardutama');
        }

        if (Auth::guard('operatordesa')->check() && Auth::guard('operatordesa')->user()->id_desausertype == 3) {
            return redirect()->route('dashboardutama');
        }

        if (Auth::guard('user')->check() && Auth::guard('user')->user()->id_desausertype == 4) {
            return redirect()->route('surat-pengajuan.index');
        }

        return $next($request);
    }
}
