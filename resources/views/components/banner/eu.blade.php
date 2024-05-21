@props(['halfwidth' => false])

<div
    @class([
        'flex items-center gap-4 px-6 py-4 text-white bg-blue-900 md:py-8 ',
        $halfwidth
            ? 'justify-start md:justify-end'
            : 'justify-center md:col-span-2',
    ])>
    <x-icon-eu class="max-h-16 sm:max-h-32 shrink-0 aspect-square" />
    <div>
        <p class="text-xl sm:text-3xl">
            {{ __('app.parliament_elections_title') }}
        </p>
        <p class="text-2xl font-medium sm:text-4xl">
            6–9 {{ Carbon\Carbon::parse('2024-06-09')->isoFormat('MMMM YYYY') }}
        </p>
    </div>
</div>
