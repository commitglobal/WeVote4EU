@props(['code', 'name', 'date'])

<div class="flex items-center gap-4 px-6 py-4 md:py-8">
    <x-dynamic-component
        :component="'icon-flags.' . $code"
        class="max-h-16 sm:max-h-24 shrink-0 aspect-square" />

    <div>
        <p class="text-xl sm:text-3xl">
            {!! __("countries.{$code}") !!}
        </p>
        <p class="text-2xl font-medium sm:text-4xl">
            {{ $date }}
        </p>
    </div>
</div>
