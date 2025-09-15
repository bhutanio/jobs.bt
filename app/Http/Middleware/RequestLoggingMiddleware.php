<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestLoggingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $start = microtime(true);

        /** @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $next($request);

        $duration_ms = (int) ((microtime(true) - $start) * 1000);

        Log::info('request', [
            'method' => $request->getMethod(),
            'path' => $request->getPathInfo(),
            'status' => $response->getStatusCode(),
            'duration_ms' => $duration_ms,
            'ip' => $request->ip(),
            'user_id' => optional($request->user())->id,
            'request_id' => $request->headers->get('X-Request-Id') ?? null,
        ]);

        return $response;
    }
}
