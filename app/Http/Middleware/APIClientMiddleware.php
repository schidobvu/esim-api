<?php

namespace App\Http\Middleware;

use App\Models\PassportClient;
use Bluecloud\ResponseBuilder\ResponseBuilder;
use Closure;
use Illuminate\Http\Request;

class APIClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $key = $request->header('x-api-key');

        if (is_null($key)) return (new ResponseBuilder())->unauthorized('API key not provided')->json();

        $client = PassportClient::findByKey($key);

        if (is_null($client)) return (new ResponseBuilder())->unauthorized('API key is not valid')->json();

        return $next($request);
    }
}
