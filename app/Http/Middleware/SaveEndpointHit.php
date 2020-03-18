<?php

namespace App\Http\Middleware;

use App\Hit;
use Closure;
use Illuminate\Support\Facades\Log;

class SaveEndpointHit
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
        $response = $next($request);
        $path = $request->path();
        $method = $request->method();
        $ip = $request->ip();
        $params = json_encode($request->query());
        $code = $response->status();

        Hit::create([
            'path' => $path,
            'method' => $method,
            'query_params' => $params,
            'request_ip' => $ip,
            'response_code' => $code
        ]);

        return $response;
    }
}
