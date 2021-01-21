<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckServerToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken()) {

            // For 'create' route
            if ($request->isMethod('POST')) {
                $user = User::where('api_token', $request->bearerToken())->first();
                if ($user) {
                    $request->merge(['user_id' => $user->id]);
                    return $next($request);
                } else {
                    return response()->json('User is not found', 403);
                }
            }

            $userHasServers = User::whereHas('servers', function ($query) use ($request) {
                $query->where('id', $request->id);
            })->where('api_token', $request->bearerToken())->first();
            if ($userHasServers) {
                return $next($request);
            } else {
                return response()->json('User is not the owner of this server', 403);
            }

        }
        return response()->json('Token not found', 403);
    }
}
