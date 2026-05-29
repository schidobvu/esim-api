<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use TNM\Utils\Factories\TransactionIDFactory;

class TransactionIDMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!defined('LARAVEL_START')) define('LARAVEL_START', microtime(true));

        $request->merge(['trans_id' => (new TransactionIDFactory(21))->make()]);

        return $next($request);
    }
}
