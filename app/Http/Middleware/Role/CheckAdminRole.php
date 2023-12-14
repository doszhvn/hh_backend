<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->role == 'admin') {
            return $next($request);
        }
        return response()->json(['error' => 'Access denied. You must be an admin.'], 403);
    }
}
