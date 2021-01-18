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

            $user = User::whereHas('servers', function ($query) use ($request) {
                $query->where('id', $request->id);
            })->where('api_token', $request->bearerToken())->get();
            if (isset($user[0])) {
                $request->merge(["user_id" => $user[0]['id']]);
                return $next($request);
            } else {
                return response()->json(['User is not found'], 403);
            }

        } else {
            return response()->json(['Token not found'], 403);
        }
    }
}
