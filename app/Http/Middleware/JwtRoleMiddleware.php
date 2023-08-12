<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JwtRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the Authorization header exists in the request

        try {
            $user = JWTAuth::parseToken()->authenticate();
            // Check if the user has one of the required roles
            $userRoleId = $user->role_id;
            $role = Role::where('id', $userRoleId)->first();

            if ($role->status === 'D' || $user->status === 'D') {
                return response()->api(null, 'Access denied', 'Unauthorized', 403);
            }

            if (!in_array($role->nama, $roles)) {
                return response()->api(null, 'Unauthorized access', 'Unauthorized', 403);
            }
        } catch (Exception $e) {
            return response()->api(null, 'Unauthorized access', 'Unauthorized', 403);
        }
        return $next($request);
    }
}
