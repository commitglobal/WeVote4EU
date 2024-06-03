@props(['name' => null, 'title' => null, 'avatar' => null, 'links' => []])

<div class="relative flex flex-col gap-4">
    <img src="{{ Vite::asset('resources/images/experts/' . $avatar) }}" alt="{{ $name }}"
        class="w-full overflow-hidden rounded-lg shadow-lg aspect-square" />

    <div>
        <h3 class="text-lg font-semibold text-gray-900 md:text-xl">
            {{ $name }}
        </h3>

        <p class="text-sm font-medium text-gray-500">
            {{ $title }}
        </p>
    </div>

    @if (filled($links))
        <div class="flex gap-3">
            @foreach ($links as $icon => $link)
                <a href="{{ $link }}" target="_blank" rel="noopener noreferer" class="hover:opacity-60">
                    <x-dynamic-component :component="$icon" class="w-5 h-5" />
                </a>
            @endforeach
        </div>
    @endif
</div>
