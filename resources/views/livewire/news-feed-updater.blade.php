<div class="sticky top-0 z-10">
    <div x-show="visible"
        x-cloak
        x-data="{
            visible: $wire.entangle('visible'),
            close() {
                this.visible = false;
                $wire.$parent.reload();
            }
        }"
        class="p-4 border-l-4 shadow border-secondary-600 bg-secondary-100">
        <div class="flex gap-3">
            <x-ri-information-fill class="w-5 h-5 text-secondary-500 shrink-0" />

            <div class="flex flex-wrap flex-1 gap-3 md:justify-between">
                <p class="text-sm text-secondary-700">
                    {{ __('app.newsfeed.updated') }}
                </p>

                <button x-on:click.prevent="close"
                    2x-on:click.prevent="$dispatch('refresh-feed')"
                    class="text-xs font-medium text-secondary-700 whitespace-nowrap hover:text-secondary-600 flex gap-1.5 items-center group">
                    <span>{{ __('app.newsfeed.refresh') }}</span>

                    <x-ri-refresh-line
                        class="w-4 h-4 transition-transform group-hover:rotate-45 group-focus:rotate-45" />
                </button>

            </div>
        </div>
    </div>
</div>
