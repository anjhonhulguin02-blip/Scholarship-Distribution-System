<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Baseline security headers. The app previously shipped none of these.
 * CSP is intentionally report-only-ish in scope: the pages load Bootstrap,
 * jQuery, Font Awesome, Google Fonts, SweetAlert2 and ethers.js from several
 * CDNs plus inline <script> blocks for session-flash toasts, so a strict
 * CSP would need those templates reworked to use nonces/external files
 * first. Documented as a follow-up rather than silently left out.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}
