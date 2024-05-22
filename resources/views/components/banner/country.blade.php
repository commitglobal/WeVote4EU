@props(['code', 'name', 'date'])

<div class="flex items-center gap-4 px-4 py-4 sm:py-8 lg:px-8">
    <x-dynamic-component
        :component="'icon-flags.' . $code"
        class="h-16 sm:h-20 md:h-24 lg:h-28 shrink-0 aspect-square" />
    <div>
        <p class="text-xl sm:text-3xl">
            {!! __("countries.{$code}") !!}
        </p>
        <p class="text-2xl font-medium sm:text-4xl">
            {{ $date }}
        </p>
    </div>
</div>
