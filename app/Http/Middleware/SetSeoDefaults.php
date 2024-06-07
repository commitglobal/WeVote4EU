<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

class SetSeoDefaults
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        seo()
            ->withUrl()
            ->title(
                default: config('app.name') . ' - ' . __('app.hero.title')  . ' ' . __('app.hero.name'),
                modifier: fn (string $title) => $title . ' — ' . config('app.name')
            )
            ->description(default: __('app.hero.description'))
            ->image(Vite::asset('resources/images/cards/eu.png'));

        return $next($request);
    }
}
