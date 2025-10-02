<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     * [what]: Extend API authentication by including user type checking
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type)
    {
        if ($request->user()->user_type !== $type) {
            Log::critical('Unauthorized access detected!!', [
                'email' => $request->user()->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'access_method' => 'API',
            ]);
            return response()->json(['message' => 'Access denied.'], 403);
        }

        return $next($request);
    }
}
