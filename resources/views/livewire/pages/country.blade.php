<div class="relative grid items-stretch isolate md:grid-cols-2">
    <x-banner.eu :halfwidth="true" />

    <x-banner.country :name="$country" :code="$code" :date="$date" />

    <div class="py-12 md:py-24 lg:py-32 bg-blue-50 md:col-span-2">
        <div
            class="container max-w-6xl"
            x-on:popstate.window="updateStep"
            x-init="updateStep(true)"
            wire:key="{{ $country }}"
            x-data="{
                baseUrl: @js(localizedRoute('country', ['country' => 'COUNTRY', 'step' => 'STEP'])),
                country: $wire.entangle('country'),
                step: @js($step),
                steps: {{ collect($items?->keys()) }},
                isCurrent(step) {
                    return this.step === step;
                },
                goTo(country, step = null, replace = false) {
                    console.log(country, step, replace);

                    this.step = this.steps.includes(step) ? step : this.steps[0];

                    let refresh = false;

                    if (this.country !== country) {
                        this.country = country;
                        refresh = true;
                    }

                    const url = this.baseUrl
                        .replace('COUNTRY', this.country)
                        .replace('STEP', this.step || '');

                    if (replace) {
                        history.replaceState(null, document.title, url.toString());
                    } else {
                        history.pushState(null, document.title, url.toString());
                    }

                    if (refresh) {
                        $wire.$refresh();
                    }
                },
                updateStep(replaceState = false) {
                    if (!this.country) {
                        return;
                    }

                    const step = location.href.split('/').pop();

                    this.goTo(this.country, step, replaceState);
                }
            }">

            @forelse ($items as $id => $options)
                <div
                    id="{{ $id }}"
                    class="flex flex-col gap-2 py-2"
                    x-show="isCurrent(@js($id))"
                    x-cloak>
                    @if (filled($options))
                        <h2 class="mb-4 text-2xl font-medium text-left text-gray-900">
                            {!! __("country-{$country}.$id") !!}
                        </h2>
                        <div @class([
                            'grid gap-4',
                            count($options) === 2 ? 'sm:grid-cols-2' : 'sm:grid-cols-3',
                        ])>
                            @foreach ($options as $option)
                                @if (array_key_exists('country', $option))
                                    @php
                                        $nextCountry = data_get(app('countries'), $option['country']);
                                    @endphp

                                    <x-decision-tree.choice
                                        :href="localizedRoute('country', [
                                            'country' => $nextCountry['name'],
                                        ])"
                                        wire:navigate>
                                        <x-dynamic-component :component="'icon-flags.' . $option['country']" class="w-8 h-8" />
                                        <span>{{ $nextCountry['label'] }}</span>
                                    </x-decision-tree.choice>
                                @else
                                    <x-decision-tree.choice
                                        x-on:click.prevent="goTo({{ Js::from($country)->toHtml() }}, {{ Js::from($option['target'])->toHtml() }})"
                                        :href="localizedRoute('country', [
                                            'country' => $country,
                                            'step' => $option['target'],
                                        ])">
                                        {!! __("country-{$country}.{$option['label']}") !!}
                                    </x-decision-tree.choice>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div
                            class="prose max-w-3xl mx-auto md:prose-lg lg:prose-xl  prose-a:text-primary-500 prose-a:font-medium hover:prose-a:no-underline">
                            {!! __("country-{$country}.$id") !!}
                        </div>
                    @endif
                </div>
            @empty
                <h2 class="mb-4 text-2xl font-medium text-left text-gray-900">
                    {!! __('app.select_nationality') !!}
                </h2>
                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach (app('countries') as $code => $country)
                        <x-decision-tree.choice
                            :href="localizedRoute('home', ['country' => $country['name']])"
                            wire:navigate>
                            <x-dynamic-component :component="'icon-flags.' . $code" class="w-8 h-8 shrink-0" />
                            <span>{{ $country['label'] }}</span>
                        </x-decision-tree.choice>
                    @endforeach
                </div>
            @endforelse

            @if ($country)
                <div class="flex flex-wrap justify-between gap-2 text-sm mt-4">
                    <div>
                        <button type="button" x-on:click="history.back()"
                            class="inline-flex items-center text-gray-600 hover:text-gray-400 focus:text-gray-400 gap-1">
                            <x-ri-arrow-left-line class="w-4 h-4" />

                            {{ __('app.action.back') }}
                        </button>
                    </div>
                    <div class="flex gap-2 justify-end">
                        @foreach ($languages as $locale => $language)
                            @if (app()->getLocale() === $locale)
                                <span class="font-medium">{{ $language['nativeName'] }}</span>
                            @else
                                <a
                                    href="{{ route('country', [
                                        'country' => $country,
                                        'locale' => $locale,
                                        'step' => $step,
                                    ]) }}"
                                    class="underline text-gray-600 hover:text-gray-400 focus:text-gray-400"
                                    wire:navigate>
                                    {{ $language['nativeName'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
