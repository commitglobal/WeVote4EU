@props(['name' => null, 'logo' => null, 'url' => null])

@php
    if (blank($url)) {
        $tag = 'div';
        $target = null;
        $rel = null;
    } else {
        $tag = 'a';
        $target = '_blank';
        $rel = 'noopener noreferer';
    }
@endphp

<{{ $tag }}
    {{ $attributes->class([
            'relative flex aspect-square items-center justify-center p-6 sm:p-4 md:p-8 group',
            'border border-primary-800',
        ])->merge([
            'href' => $url,
            'target' => $target,
            'rel' => $rel,
        ]) }}>

    <img src="{{ Vite::asset('resources/images/partners/' . $logo) }}" alt="{{ $name }}" class="object-contain" />

    <div
        @class([
            'absolute inset-0 flex items-center justify-center',
            'font-bold text-xl sm:text-lg md:text-2xl lg:text-3xl',
            'text-white bg-primary-800',
            'p-6 sm:p-4 md:p-8',
            'opacity-0 group-hover:opacity-100 group-focus:opacity-100',
            'transition-opacity duration-300 ease-in-out',
        ])>
        {{ $name }}
    </div>

    </{{ $tag }}>
