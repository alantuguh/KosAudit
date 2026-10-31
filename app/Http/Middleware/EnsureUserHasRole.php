<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Membatasi akses route berdasarkan role.
 *
 * Pemakaian di route:
 *   ->middleware('role:owner')
 *   ->middleware('role:owner,tenant')   // salah satu role cukup
 *
 * Selalu pasang setelah 'auth:sanctum'.
 */
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['message' => 'Silakan login terlebih dahulu.'], Response::HTTP_UNAUTHORIZED);
        }

        if (! $user->hasRole(...$roles)) {
            return response()->json(['message' => 'Anda tidak memiliki akses ke fitur ini.'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
