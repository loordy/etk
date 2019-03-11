<?php

namespace App\Http\Middleware;

use Closure;

class Cache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  float|int  $cacheMinutes
     * @return mixed
     */
    public function handle($request, Closure $next, $cacheMinutes = 1,$type = 'private')
    {
        $response = $next($request);
        $response->headers->set('Cache-Control', $type.',max-age='.$cacheMinutes*60);
        return $response;
    }
}
