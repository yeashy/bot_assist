<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class VerifyClient
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $companyId = Route::current()->parameter('companyId');

        if (!$companyId) {
            return response()->json([
                'message' => 'CompanyId is undefined.',
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        /** @var User $user */
        $user = Auth::user();

        $client = $user->client($companyId);

        if (empty($client)) {
            return response()->json([
                'message' => 'Client not found.',
            ])->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
