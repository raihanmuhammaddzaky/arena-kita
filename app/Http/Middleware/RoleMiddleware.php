<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Unauthorized access.');
        }

        // Jika user masih pending, redirect ke halaman pending
        if (auth()->user()->status === 'pending') {
            return redirect()->route('pending');
        }

        return $next($request);
    }
}
