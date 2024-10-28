<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAplikasiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('adminaplikasi')->check() || Auth::guard('adminaplikasi')->user()->id_desausertype != 2) {
            return $next($request);
        }
        return redirect()->route('login')->withErrors('Silahkan Login Dahulu... #1');
    }

}
