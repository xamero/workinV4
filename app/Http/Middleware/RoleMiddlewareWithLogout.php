<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddlewareWithLogout
{
    public function handle(Request $request, Closure $next, $role, $guard = 'web')
    {
        $user = Auth::guard($guard)->user();

        if (!$user) {
            throw UnauthorizedException::notLoggedIn();
        }

        $roles = is_array($role) ? $role : explode('|', $role);

        if (!$user->hasAnyRole($roles)) {
            // Logout user in Fortify (session-based auth)
            Auth::guard($guard)->logout();

            // Invalidate session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('error', 'You are not authorized to access this page. You have been logged out.');
        }

        return $next($request);
    }
}
