@props(['href' => null])

@php
    $class = [
        'group text-lg',
        'flex items-center w-full gap-4 px-4 py-5',
        'text-start bg-white rounded-lg shadow-md',
        'ring-2 ring-inset ring-transparent',

        'hover:ring-secondary-500',
        'focus:ring-secondary-500 focus:outline-hidden',
        'active:bg-secondary-100',
    ];
@endphp

@if (filled($href))
    <a {{ $attributes->merge([
            'href' => $href,
        ])->class($class) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge([
            'type' => 'button',
        ])->class($class) }}>
        {{ $slot }}
    </button>
@endif
