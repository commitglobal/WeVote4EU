<section class="container relative max-w-6xl py-32 md:py-48">
    <div
        class="prose md:prose-lg lg:prose-xl max-w-none prose-headings:font-semibold prose-a:text-primary-800 prose-a:font-medium hover:prose-a:no-underline">
        <h2>{{ __('app.votemonitor.title') }}</h2>
        <div class="mt-6 text-gray-500">
            {!! Str::markdown(__('app.votemonitor.description')) !!}
        </div>
    </div>

    <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-6">
        @foreach ($counters as $key => $value)
            <div @class([
                'px-4 py-5 overflow-hidden bg-white rounded-lg drop-shadow sm:p-6',
                'ring-1 ring-gray-200',
                $loop->iteration <= 3 ? 'sm:col-span-2' : 'sm:col-span-3',
            ])>
                <dt class="text-sm font-medium text-gray-500 truncate">{{ __("app.votemonitor.counters.$key") }}</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $value }}</dd>
            </div>
        @endforeach
    </dl>
</section>
