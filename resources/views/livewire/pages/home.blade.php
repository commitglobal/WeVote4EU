<div class="relative isolate pt-14">
    <div class="container py-32 mx-auto sm:py-48 lg:py-56">
        <div class="prose md:prose-lg lg:prose-2xl">
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

    <div class="py-12 md:py-24 lg:py-32 xl:py-48 bg-blue-50 md:col-span-2">
        <div class="container max-w-6xl">
            <h2 class="mb-4 text-2xl font-medium text-left text-gray-900">
                {!! __('app.select-nationality') !!}
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
