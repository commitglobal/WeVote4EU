<div class="grid">

    <div
        class="flex items-center justify-center gap-4 px-6 py-4 text-white bg-blue-900 md:py-8">
        <x-icon-eu class="max-h-20 sm:max-h-24" />
        <div>
            <p class="text-xl sm:text-4xl">Parliament elections</p>
            <p class="text-2xl font-medium sm:text-5xl">6-9 June 2024</p>
        </div>

    </div>
    <div class="py-12 md:py-24 lg:py-32 xl:py-48 bg-blue-50">
        <div
            class="container max-w-3xl"
            x-on:popstate.window="updateStep"
            x-init="updateStep(true)"
            wire:key="{{ $country }}"
            x-data="{
                baseUrl: @js(localizedRoute('home', ['country' => 'COUNTRY', 'step' => 'STEP'])),
                country: $wire.entangle('country'),
                step: @js($step),
                steps: {{ collect($items?->keys()) }},
                isCurrent(step) {
                    return this.step === step;
                },
                goTo(country, step, replace = false) {
                    this.step = this.steps.includes(step) ? step : this.steps[0];

                    const url = this.baseUrl
                        .replace('COUNTRY', country)
                        .replace('STEP', this.step || '');

                    if (replace) {
                        history.replaceState(null, document.title, url.toString());
                    } else {
                        history.pushState(null, document.title, url.toString());
                    }

                    if (this.country !== country) {
                        this.country = country;
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
                                @if (array_key_exists('flag', $option))
                                    <x-decision-tree.choice
                                        x-on:click.prevent="goTo({{ Js::from($option['target'])->toHtml() }})"
                                        :href="localizedRoute('home', [
                                            'country' => $option['target'],
                                        ])">
                                        <x-dynamic-component :component="'icon-flags.' . $option['flag']" class="w-8 h-8" />
                                        <span>{{ $option['label'] }}</span>
                                    </x-decision-tree.choice>
                                @else
                                    <x-decision-tree.choice
                                        x-on:click.prevent="goTo({{ Js::from($country)->toHtml() }}, {{ Js::from($option['target'])->toHtml() }})"
                                        :href="localizedRoute('home', [
                                            'country' => $country,
                                            'step' => $option['target'],
                                        ])">
                                        {!! __("country-{$country}.{$option['label']}") !!}
                                    </x-decision-tree.choice>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="prose">
                            {!! __("country-{$country}.$id") !!}
                        </div>
                    @endif
                </div>
            @empty
                <h2 class="mb-4 text-2xl font-medium text-left text-gray-900">
                    {!! __('app.select-nationality') !!}
                </h2>
                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach (app('countries') as $code => $name)
                        <x-decision-tree.choice
                            x-on:click.prevent="goTo({{ Js::from($name)->toHtml() }})"
                            :href="localizedRoute('home', ['country' => $name])">
                            <x-dynamic-component :component="'icon-flags.' . $code" class="w-8 h-8 shrink-0" />
                            <span>{{ __("countries.{$code}") }}</span>
                        </x-decision-tree.choice>
                    @endforeach
                </div>
            @endforelse
        </div>
    </div>
</div>
