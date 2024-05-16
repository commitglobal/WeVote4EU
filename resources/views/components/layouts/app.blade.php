<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen font-sans antialiased bg-gray-50">
    <x-site.skip-to-content />

    <x-site.header />

    <main id="content" class="flex-1 mb-12 lg:mb-16">
        {{ $slot }}
    </main>

    <x-site.footer />

    @livewireScripts
</body>

</html>
