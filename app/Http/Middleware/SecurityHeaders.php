<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Set Content-Security-Policy header
        $csp = "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' https://trusted-scripts.com https://cdnjs.cloudflare.com https://kit.fontawesome.com/f30dc711e6.js https://code.jquery.com; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css; " .
            "img-src 'self' data:; " .
            "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com https://ka-f.fontawesome.com; " .
            "connect-src 'self' https://ka-f.fontawesome.com; " .
            "frame-src 'self';";
        $response->headers->set('Content-Security-Policy', $csp);

        // Add the X-Frame-Options header
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Set the X-Content-Type-Options header to prevent MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');


        // Add X-Frame-Options header to prevent iframe embedding
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');  // or 'DENY' to disallow all framing


        // Set Strict-Transport-Security header
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        return $response;
    }
}
