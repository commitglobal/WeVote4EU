<header x-data="{ menuOpen: false }" class="fixed inset-x-0 z-40 bg-white shadow md:relative">
    <nav class="container flex justify-between gap-4 py-4">
        <a href="{{ localizedRoute('home') }}" class="flex items-center gap-2" wire:navigate>
            <x-icon-logo class="h-7 md:h-10" />
        </a>

        <div class="relative flex items-center gap-2">
            <div class="items-center hidden gap-2 md:flex">
                <x-navigation-item route="home" label="Homepage" />
                <x-navigation-item route="about" label="About this platform" />
                <x-navigation-item route="partners" label="Partners" />
            </div>

            <div x-data="{ langOpen: false }" x-on:click.away="langOpen = false">
                <button
                    class="flex items-center gap-1 px-3 py-2 font-light text-blue-900 rounded hover:bg-blue-50 focus:bg-blue-100 focus:outline-none"
                    x-on:click="langOpen = !langOpen">
                    <x-ri-translate class="w-5 h-5" />
                    <span class="font-medium">{{ currentLocale()['nativeName'] }}</span>
                    <x-ri-arrow-drop-down-line class="w-5 h-5 ml-1 -mr-1" />
                </button>

                <div
                    class="absolute right-0 w-48 mt-2 origin-top-right bg-white shadow-lg"
                    x-show="langOpen"
                    x-collapse
                    x-cloak>
                    <ul class="overflow-y-auto  max-h-[75vh]">
                        @foreach ($alternateUrls as $locale => $item)
                            <li class="text-sm">
                                <a
                                    class="flex px-3 py-2 rounded hover:bg-gray-100 focus:bg-gray-200 focus:outline-none"
                                    hreflang="{{ $locale }}"
                                    href="{{ $item['url'] }}"
                                    wire:navigate>
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button type="button" @@click="menuOpen = !menuOpen" class="md:hidden">
                <x-ri-menu-line x-show="!menuOpen" class="w-5 h-5" />
                <x-ri-close-line x-show="menuOpen" class="w-5 h-5" x-cloak />
            </button>
        </div>
    </nav>
</header>
