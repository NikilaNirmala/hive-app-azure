<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LimitUserType
{
    /**
     * Handle an incoming request.
     * [what]: Extend Web route based authentication by including the user type check
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {
        if ($request->user()->user_type != $type ) {
            Log::critical('Unauthorized access detected!!', [
                'email' => $request->user()->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'access_method' => 'WEB',
            ]);
            abort(401, 'access denied');
        }
        return $next($request);
    }
}
