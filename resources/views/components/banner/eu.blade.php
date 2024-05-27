@props(['halfwidth' => false])

<div
    id="elections"
    @class([
        'flex items-center gap-4 px-4 py-4 text-white bg-blue-900 sm:py-8',
        $halfwidth
            ? 'justify-start lg:justify-end lg:px-8'
            : 'justify-center lg:col-span-2',
    ])>
    <x-icon-eu class="h-16 sm:h-20 md:h-24 lg:h-32 shrink-0 aspect-square" />
    <div>
        <p class="text-xl sm:text-3xl">
            {{ __('app.parliament_elections_title') }}
        </p>
        <p class="text-2xl font-medium sm:text-4xl">
            6–9 {{ Carbon\Carbon::parse('2024-06-09')->isoFormat('MMMM YYYY') }}
        </p>
    </div>
</div>
