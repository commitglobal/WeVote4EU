<div class="relative">
    <x-hero>
        <x-slot name="title">
            <span class="font-light text-slate-900">
                {{ __('app.hero.title') }}
            </span>
            <span class="font-semibold text-primary-800">
                {{ __('app.hero.name') }}
            </span>
        </x-slot>

        <x-slot name="description">
            <p>{{ __('app.hero.description') }}</p>
        </x-slot>

    </x-hero>

    <x-banner.eu />

    <div class="py-12 md:py-24 lg:py-32 bg-primary-50 md:col-span-2">
        <div class="container max-w-6xl">
            <h2 class="mb-4 text-2xl font-medium text-left text-gray-900">
                {!! __('app.select_nationality') !!}
            </h2>
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach (app('countries') as $code => $country)
                    <x-decision-tree.choice
                        :href="localizedRoute('country', ['country' => $country['name']])"
                        wire:navigate>
                        <x-dynamic-component :component="'icon-flags.' . $code" class="w-8 h-8 shrink-0" />
                        <span>{{ $country['label'] }}</span>
                    </x-decision-tree.choice>
                @endforeach
            </div>
        </div>
    </div>
</div>
