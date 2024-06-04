@props(['name' => null, 'title' => null, 'avatar' => null, 'links' => []])

<div class="relative flex flex-col gap-4">
    <div class="flex items-center justify-center overflow-hidden shadow-lg aspect-square">
        <img src="{{ Vite::asset('resources/images/experts/' . $avatar) }}" alt="{{ $name }}"
            class="object-contain" />
    </div>

    <div>
        <h2 class="text-lg font-semibold text-gray-900 md:text-xl">
            {{ $name }}
        </h2>

        <p class="text-sm font-medium text-gray-500">
            {{ $title }}
        </p>
    </div>

    @if (filled($links))
        <div class="flex gap-3">
            @foreach ($links as $link)
                <a href="{{ $link['url'] }}"
                    title={{ $link['title'] }}
                    target="_blank"
                    rel="noopener noreferer"
                    class="hover:opacity-60">
                    <x-dynamic-component :component="$link['icon']" class="w-5 h-5" />
                </a>
            @endforeach
        </div>
    @endif
</div>
