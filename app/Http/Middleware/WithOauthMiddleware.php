<?php

namespace App\Http\Middleware;

use Closure;

class WithOauthMiddleware
{
    public function handle($request, Closure $next)
    {
        switch ($request->route()->getName()) {
            case 'auth.login' : {
                $request->merge([
                    'client_id' => config('oauth.schedule_id'),
                    'client_secret' => config('oauth.schedule_secret'),
                    'grant_type' => config('oauth.password_type')
                ]);
                break;
            }
            case 'auth.refresh' : {
                $request->merge([
                    'client_id' => config('oauth.schedule_id'),
                    'client_secret' => config('oauth.schedule_secret'),
                    'grant_type' => config('oauth.refresh_type')
                ]);
                break;
            }
            default : {
                break;
            }
        }
        return $next($request);
    }
}
