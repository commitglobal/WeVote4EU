<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#243e90">
    <meta name="theme-color" content="#ffffff">

    <x-seo::meta />

    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }

        :root {
            --font-family: 'Inter';
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @filamentStyles
    @vite('resources/css/app.css')

    <x-site.analytics />
</head>

<body class="flex flex-col min-h-screen font-sans antialiased bg-white">
    <x-site.banner />
    <x-site.skip-to-content />

    <x-site.header />

    <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
        aria-hidden="true">
        <defs>
            <pattern
                id="grid-pattern"
                width="200"
                height="200"
                x="50%" y="-1"
                patternUnits="userSpaceOnUse">
                <path d="M.5 200V.5H200" fill="none" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" stroke-width="0" fill="url(#grid-pattern)" />
    </svg>

    <main id="content" class="flex-1">
        {{ $slot }}
    </main>

    <x-site.footer />

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
