<header class="bg-white shadow">
    <div class="container flex justify-between gap-4 py-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <x-icon-logo class="h-7 md:h-10" />
        </a>

        <nav class="flex items-center gap-2">
            <x-navigation-item route="home" label="Homepage" />
            <x-navigation-item route="about" label="About this platform" />
            <x-navigation-item route="partners" label="Partners" />
        </nav>
    </div>
</header>
