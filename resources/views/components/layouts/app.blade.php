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
    </style>
    @vite(['resources/css/filament/admin/theme.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased">
    <header class="bg-white shadow">
        <div class="container flex justify-between gap-4 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <x-icon-logo class="h-7 md:h-10" />
            </a>

            <nav></nav>
        </div>

    </header>

    {{ $slot }}

    @livewireScripts
</body>

</html>
