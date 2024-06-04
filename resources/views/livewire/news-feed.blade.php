<section id="newsfeed" class="relative py-32 bg-primary-50 md:py-48">
    <div class="container max-w-6xl">
        <div
            class="prose md:prose-lg lg:prose-xl max-w-none prose-headings:font-semibold prose-a:text-primary-800 prose-a:font-medium hover:prose-a:no-underline">
            <h2 class="flex items-center gap-3 sm:gap-6">
                <span>{{ __('app.newsfeed.title') }}</span>
                <x-ri-rfid-line class="w-8 md:w-12" />
            </h2>
            <div class="mt-6 text-gray-500">
                {!! Str::markdown(__('app.newsfeed.description')) !!}
            </div>
        </div>

        <form>
            {{ $this->form }}
        </form>

        <div class="grid gap-4 mt-10 sm:gap-8">
            @forelse ($posts as $post)
                <x-news-feed-item :post="$post" />
            @empty
                <p>No Posts Found</p>
            @endforelse

            <div
                class="overflow-hidden bg-white rounded-lg shadow animate-pulse"
                wire:loading.delay>
                <div class="sr-only">Loading...</div>
                <div class="flex flex-col gap-4 px-4 py-5 sm:p-6">
                    <header class="relative flex items-center gap-x-4">
                        <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-3 bg-gray-100 rounded max-w-40"></div>
                            <div class="h-3 bg-gray-100 rounded max-w-56"></div>
                        </div>
                    </header>

                    <div class="flex flex-col gap-5">
                        <div class="h-3 max-w-lg bg-gray-200 rounded"></div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="h-3 col-span-2 bg-gray-100 rounded"></div>
                            <div class="h-3 col-span-1 bg-gray-100 rounded"></div>
                        </div>
                        <div class="h-3 bg-gray-100 rounded"></div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="h-3 col-span-1 bg-gray-100 rounded"></div>
                            <div class="h-3 col-span-2 bg-gray-100 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($this->hasMore)
                <div x-intersect="$wire.loadMore()"></div>
            @endif
        </div>

    </div>

</section>
