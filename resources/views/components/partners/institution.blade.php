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
    {{ $attributes->class(['relative flex flex-col gap-4 group focus:outline-hidden'])->merge([
        'href' => $url,
        'target' => $target,
        'rel' => $rel,
    ]) }}>

    <div
        class="flex items-center justify-center p-6 overflow-hidden shadow-sm sm:p-4 md:p-8 aspect-square ring-1 ring-primary-800">
        <img src="{{ $logo }}" alt="{{ $name }}" class="object-contain" />
    </div>

    <h2 class="text-lg font-semibold text-gray-900 md:text-xl group-hover:underline group-focus:underline">
        {{ $name }}
    </h2>

    </{{ $tag }}>
