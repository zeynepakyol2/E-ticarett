<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use const http\Client\Curl\AUTH_ANY;
use Auth;
class Yonetim
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('yonetim')->check() && Auth::guard('yonetim')->user()->yonetici_mi)
        {
            return $next($request);// eğer giriş yapan tönetici ise sorun yok devam et
        }
            return redirect()->route('yonetim.oturumac');
    }
}
