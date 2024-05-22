<div class="relative">
    <div class="container relative max-w-6xl py-32 md:py-48">

        <x-icon-hero class="absolute inset-y-0 right-0 hidden h-full py-16 lg:block rotate-12" />
        <div class="prose md:prose-lg lg:prose-xl">
            <h1>
                <span class="font-light text-slate-900">
                    Empowering EU Democracy through
                </span>
                <span class="font-semibold text-blue-800">
                    We Vote for EU
                </span>
            </h1>

            <p class="mt-6 text-gray-500">
                Lorem ipsum dolor sit amet consectetur. Ultricies sit massa dictum senectus ut. Tellus id varius
                tellus
                consectetur erat suspendisse. Malesuada varius vitae nisl in et ipsum ultricies hendrerit nisl.
            </p>
        </div>
    </div>

    <x-banner.eu />

    <div class="py-12 md:py-24 lg:py-32 bg-blue-50 md:col-span-2">
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
