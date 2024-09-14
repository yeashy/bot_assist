<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class VerifySession
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Trying to auth. ' . Auth::user()?->id . ' | ' . microtime(true));

        if (!Auth::user()) {
            return response()->json([
                'message' => 'User is not logged in.',
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
