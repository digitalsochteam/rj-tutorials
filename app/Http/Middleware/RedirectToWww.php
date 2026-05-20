<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToWww
{
    public function handle(Request $request, Closure $next): Response
    {
        $hostHeader = $request->headers->get('X-Forwarded-Host');
        $host = $hostHeader ? trim(explode(',', $hostHeader)[0]) : $request->getHost();

        // Skip local/IP hosts so local development keeps working.
        if ($host === 'localhost' || filter_var($host, FILTER_VALIDATE_IP)) {
            return $next($request);
        }

        if (!str_starts_with($host, 'www.')) {
            $url = 'https://www.' . $host . $request->getRequestUri();
            return redirect()->to($url, 301);
        }

        return $next($request);
    }
}