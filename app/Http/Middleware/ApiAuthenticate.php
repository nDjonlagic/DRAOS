<?php

namespace App\Http\Middleware;

use Closure;

use App\Services\AuthService;
use Illuminate\Support\Facades\Auth; // <- import the namespace

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // initilize authservice instance
        $authService = new AuthService;

        if($request->user() == null) {
            // token
            $token = $request->header('Authorization');

            // fetch user
            $user = $authService->authorization($token);

            if($user == null) {
                return response()->json(null, 401);
            } else {
                Auth::onceUsingId($user->id);
            }
        }

        return $next($request);
    }
}
