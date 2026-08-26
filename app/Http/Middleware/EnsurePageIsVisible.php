<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePageIsVisible
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $page): Response
    {
        $settings = SiteSetting::current();

        $column = 'show_'.$page;

        if (! $settings->{$column}) {
            abort(404);
        }

        return $next($request);
    }
}
