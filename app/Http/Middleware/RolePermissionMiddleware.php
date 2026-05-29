<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Bluecloud\ResponseBuilder\ResponseBuilder;
use Closure;
use Illuminate\Http\Request;

class RolePermissionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!request()->user() || !isset(request()->user()->{'role'})) return (new ResponseBuilder())->unauthenticated()->json();

        $hasPermission = request()->user()->{'role'}->permissions->contains(function (Permission $permission) {
            return $permission->{'endpoint'} == request()->route()->uri && $permission->{'method'} == request()->method();
        });

        if (!$hasPermission) return (new ResponseBuilder())->unauthorized()->json();

        return $next($request);
    }
}
