<?php

namespace App\Http\Middleware;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'versions' => [
                'php'     => PHP_VERSION,
                'laravel' => \Illuminate\Foundation\Application::VERSION,
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
            ],
            'auth.user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,
            // use this if you want to add role to auth.user
            // 'auth.user' => function () {
            //     $user = auth()->user();

            //     if (! $user instanceof User) {
            //         return null;
            //     }

            //     return $user->only('id', 'name', 'email') + [
            //         'role' => $user->getRoles()->first()?->getAttribute('slug'),
            //     ];
            // },
            'breadcrumbs' => fn () => Breadcrumbs::generate(),
        ]);
    }
}
