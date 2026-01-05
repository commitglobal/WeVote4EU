<div>
    @if ($this->count)
        <section class="container relative max-w-6xl py-32 md:py-48">
            <div
                class="prose md:prose-lg lg:prose-xl max-w-none prose-headings:font-semibold prose-a:text-primary-800 prose-a:font-medium prose-a:hover:no-underline prose-headings:mt-0">

                <h2 class="flex items-center gap-2 sm:gap-4">
                    <x-icon-votemonitor class="h-12 sm:h-16" />
                    <span>{{ __('app.votemonitor.title') }}</span>
                </h2>
                <div class="mt-6 text-gray-500">
                    {!! Str::markdown(__('app.votemonitor.description')) !!}
                </div>

            </div>

            @php
                switch (count($this->stats)) {
                    case 'value':
                        # code...
                        break;

                    default:
                        # code...
                        break;
                }
            @endphp

            <dl @class(['grid gap-5 mt-5', $this->gridColumns()])>
                @foreach ($this->stats as $stat)
                    <div @class([
                        'px-4 py-5 overflow-hidden bg-white rounded-lg drop-shadow-sm sm:p-6',
                        'ring-1 ring-gray-200',
                        $this->count > 4 && $loop->iteration <= 3
                            ? 'sm:col-span-2'
                            : 'sm:col-span-3',
                    ])>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            {{ __("app.stats.{$stat['key']}") }}</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stat['value'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </section>
    @endif

</div>
