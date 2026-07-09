<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Check if user has any of the allowed roles
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect based on role if access denied
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard')->with('error', 'Access denied');
        } elseif ($user->role === 'user') {
            return redirect('/user/dashboard')->with('error', 'Access denied');
        }

        return redirect('/')->with('error', 'Access denied');
    }
}
