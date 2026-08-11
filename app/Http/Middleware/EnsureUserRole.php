<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Route-level guard for the "user" (student) and "org" (provider) areas.
 *
 * The app authenticates via a plain session flag ('users') rather than
 * Laravel's Auth guard, and previously relied entirely on each controller
 * remembering to re-check session()->exists('users') and userType on every
 * single action -- easy to forget on a new controller/action, and every
 * dashboard route (org_home, user_transactions, etc.) was reachable by a
 * guest until the controller's own check ran. This middleware makes that
 * check a property of the route itself instead of something every
 * controller has to remember to repeat.
 */
class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!session()->exists('users')) {
            return redirect('/');
        }

        $user = session('users');

        if (($user['userType'] ?? null) !== $role) {
            return redirect('/logout');
        }

        return $next($request);
    }
}
