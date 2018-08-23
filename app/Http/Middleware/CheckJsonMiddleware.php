<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckJsonMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->isJson()) {
            return $next($request);
        }
        throw new HttpException(400, trans('common.is_json'), null, [], 400);
    }
}
