<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToWww
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->isProduction() && !str_starts_with($request->getHost(), 'www.')) {
            $url = 'https://www.' . $request->getHost() . $request->getRequestUri();
            return redirect($url, 301);
        }

        return $next($request);
    }
}
