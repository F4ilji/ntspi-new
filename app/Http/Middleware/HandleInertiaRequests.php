<?php

namespace App\Http\Middleware;

use App\Http\Resources\ClientNavigationResource;
use App\Models\MainSection;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? $request->user()->only('id', 'name', 'email', 'created_at') : null,
                'role' => $request->user() ? $request->user()->roles->pluck('name') : null,
                'permissions' => $request->user() ? $request->user()->getPermissionsViaRoles()->pluck('name') : null,
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'navigation' => ClientNavigationResource::collection(MainSection::with('subSections.pages.section')->orderBy('sort', 'asc')->get()),

        ];
    }
}
