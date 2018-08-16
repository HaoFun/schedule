<?php

namespace App\Http\Middleware;

use Closure;

class MergeRequestMiddleware
{
    public function handle($request, Closure $next)
    {
        $request->merge([
            'created_by' => 1,
            'updated_by' => 1
        ]);
        return $next($request);
    }
}
