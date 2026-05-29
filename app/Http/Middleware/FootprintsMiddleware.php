<?php

namespace App\Http\Middleware;

use App\Models\Footprint;
use Closure;
use Illuminate\Http\Request;

class FootprintsMiddleware
{

    private array $hidden = ['password', 'pin', 'new_pin'];

    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, $response): void
    {
        Footprint::create([
            'portal_user_id' => auth()->id() ?? null,
            'endpoint' => $request->route() ? $request->route()->uri : '',
            'uri' => $request->getRequestUri(),
            'method' => $request->method(),
            'request' => json_encode($request->except($this->hidden)),
            'response' => method_exists($response, 'content') ? $response->content() : null,
            'milliseconds' => $this->getTurnAroundTime(),
            'status' => method_exists($response, 'status') ? $response->status() : null,
            'success' => $response->isSuccessful(),
            'app_version' => $request->header('x-app-version'),
            'trans_id' => \request('trans_id'),
        ]);
    }

    private function getTurnAroundTime(): float|int
    {
            return round(microtime(true) - LARAVEL_START, 4) * 1000;
    }
}
