<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\RouteInformation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use Vyuldashev\LaravelOpenApi\Contracts\PathMiddleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware implements PathMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    public function before(RouteInformation $routeInformation): void
    {
    }

    public function after(PathItem $pathItem): PathItem
    {
        return $pathItem;
    }
}
