<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\Models\User;
use App\Models\Server;

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
        if (!$request->bearerToken()) {
            return response()->json('Token not found', 403);
        }

        if (!$request->id) {

            $user = User::where('api_token', $request->bearerToken())->first();
            if (!$user) {
                return response()->json('User is not found', 403);
            }

            $request->merge(['user_id' => $user->id]);
            return $next($request);
        }

        $server = Server::where('id', $request->id)->first();
        $serverOwner = $server->user;

        if (!$serverOwner) {
            return response()->json('Server without owner', 403);
        }

        if ($request->bearerToken() !== $serverOwner->api_token) {
            return response()->json('Invalid token', 403);
        }

        return $next($request);
    }
}
