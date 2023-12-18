<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Http\Request;

class CheckHRRole
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
        if (auth()->user()->role == 'f' || auth()->user()->role == 'admin') {
            return $next($request);
        }
        return response()->json(['error' => 'You must be an HR manager.'], 403);
    }
}
