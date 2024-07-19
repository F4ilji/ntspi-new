<?php

namespace App\Http\Middleware;

use App\Models\MainChapter;
use App\Models\MainSection;
use App\Models\Page;
use App\Models\RegisteredRoute;
use App\Models\SubChapter;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class AccessCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            if (Page::where('path', '=', $route->uri)->where('is_registered', '=', true)->exists() === false) {
                Page::create([
                    'path' => $route->uri,
                    'is_registered' => true,
                    'is_url' => false,
                    'searchable' => false,
                    'code' => 200
                ]);
            };
        }

        $registeredRoute = Page::where('path', '=', $request->route()->uri)->where('is_registered', '=', true)->first();
        if ($registeredRoute->exists() === false) {
            return $next($request);
        };


        if ($registeredRoute->code != 200) {
            abort($registeredRoute->code);
        }
        return $next($request);
    }
}
