<div id="test" class="grid">

    <div
        class="flex items-center justify-center gap-4 px-6 py-4 text-white bg-blue-900 md:py-8">
        <x-icon-eu class="max-h-20 sm:max-h-24" />
        <div>
            <p class="text-xl sm:text-4xl">Parliament elections</p>
            <p class="text-2xl font-medium sm:text-5xl">6-9 June 2024</p>
        </div>

    </div>
    <div class="px-6 py-4 bg-blue-50">
        <div class="container">
            @if (!$country)
                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach (app('countries') as $code => $name)
                        <x-decision-tree.choice
                            :href="localizedRoute('home', ['country' => $name])">
                            <x-dynamic-component :component="'icon-flags.' . $code" class="w-8 h-8" />
                            <span>{{ __("countries.{$code}") }}</span>
                        </x-decision-tree.choice>
                    @endforeach
                </div>
            @else
                @if (filled($items))
                    <div x-data="{
                        baseUrl: @js(localizedRoute('home', ['country' => $country, 'step' => 'STEP'])),
                        current: @js($step),
                        steps: {{ $items->keys() }},
                        isCurrent(step) {
                            return this.current === step;
                        },
                        goTo(step, replace = false) {
                            this.current = step;
                    
                            const url = this.baseUrl.replace('STEP', step);
                    
                            if (replace) {
                                history.replaceState(null, document.title, url.toString());
                            } else {
                                history.pushState(null, document.title, url.toString());
                            }
                        },
                        updateStep(replaceState = false) {
                            const step = location.href.split('/').pop();
                    
                            this.goTo(this.steps.includes(step) ? step : this.steps[0], replaceState);
                        }
                    }"
                        x-on:popstate.window="updateStep"
                        x-init="updateStep(true)">

                        @foreach ($items as $id => $options)
                            <div
                                id="{{ $id }}"
                                class="flex flex-col gap-2 py-2"
                                x-show="isCurrent(@js($id))"
                                x-cloak>
                                @if (filled($options))
                                    <h2 class="text-lg font-medium text-left text-gray-900 border-b">
                                        {!! __("country-{$country}.$id") !!}
                                    </h2>
                                    <div @class([
                                        'grid gap-4',
                                        count($options) === 2 ? 'sm:grid-cols-2' : 'sm:grid-cols-3',
                                    ])>
                                        @foreach ($options as $option)
                                            @if (array_key_exists('flag', $option))
                                                <x-decision-tree.choice
                                                    :href="localizedRoute('home', [
                                                        'country' => $option['target'],
                                                    ])">
                                                    <x-dynamic-component :component="'icon-flags.' . $option['flag']" class="w-8 h-8" />
                                                    <span>{{ $option['label'] }}</span>
                                                </x-decision-tree.choice>
                                            @else
                                                <x-decision-tree.choice
                                                    :href="localizedRoute('home', [
                                                        'country' => $country,
                                                        'step' => $option['target'],
                                                    ])"
                                                    x-on:click.prevent="goTo({{ Js::from($option['target'])->toHtml() }})">
                                                    {!! __("country-{$country}.{$option['label']}") !!}
                                                </x-decision-tree.choice>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="prose max-w-none">
                                        {!! __("country-{$country}.$id") !!}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
