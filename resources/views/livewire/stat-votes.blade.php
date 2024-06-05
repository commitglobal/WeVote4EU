<div>
    @if (!is_null($this->stat))
        <div class="inline-flex items-center gap-2 px-6 py-4 text-blue-900 rounded-lg bg-secondary-400">
            <span class="text-3xl font-bold tracking-widest sm:text-5xl">{{ $this->stat['value'] }}</span>

            <div class="flex flex-col items-center leading-none">
                <x-fas-vote-yea class="w-4 h-4 sm:w-6 sm:h-6" />

                <span class="text-xs font-medium sm:text-sm">{{ $this->stat['label'] }}</span>
            </div>
        </div>
    @endif
</div>
