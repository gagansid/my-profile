<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSiteVisibility
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = SiteSetting::current();

        if (! $settings->is_site_public) {
            return response()->view('pages.maintenance', [
                'message' => $settings->maintenance_message,
            ], 503);
        }

        return $next($request);
    }
}
