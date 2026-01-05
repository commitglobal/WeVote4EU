<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request):Response $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (! locales()->has($locale)) {
            return redirect()->to(
                collect($request->segments())
                    ->prepend(App::getFallbackLocale())
                    ->implode('/')
            );
        }

        App::setLocale($locale);

        return $next($request);
    }
}
