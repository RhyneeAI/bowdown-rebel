<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('auth.login');
    }

    protected function unauthenticated($request, array $guards)
    {
        $endpoint = '/login';
        $message = 'Unauthenticated';
        
        foreach (config('auth.guards') as $guard => $config) {
            if (Auth::guard($guard)->check()) {
                $endpoint = "/" . Auth::guard($guard)->user()->role->role . "/dashboard";
                $message = 'You do not have permission to access this page';
            }
        }
        
        throw new AuthenticationException(
            $message, $guards, $endpoint
        );
    }
}
