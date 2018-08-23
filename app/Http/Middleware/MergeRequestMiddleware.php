<?php

namespace App\Http\Middleware;

use Closure;

class MergeRequestMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->route()->getName() === 'auth.login') {
            $request->merge([
                'client_id' => config('oauth.schedule_id'),
                'client_secret' => config('oauth.schedule_secret')
            ]);
        }
        return $next($request);
    }
}
