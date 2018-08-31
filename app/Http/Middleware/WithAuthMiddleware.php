<?php

namespace App\Http\Middleware;

use Closure;

class WithAuthMiddleware
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
        if (auth()->check()) {
            $request->merge([
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);
        }
        return $next($request);
    }
}
