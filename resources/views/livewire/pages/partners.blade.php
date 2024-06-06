<div class="relative">
    <x-hero>
        <x-slot name="title">
            <span class="font-extrabold text-primary-800">
                {{ __('partners.title') }}
            </span>
        </x-slot>

        <x-slot name="description">
            <p>{{ __('partners.intro_1') }}</p>
            <p>{{ __('partners.intro_2') }}</p>
        </x-slot>
    </x-hero>

    @if (filled($institutions))
        <section class="container relative max-w-6xl mt-8 mb-32 sm:mb-40">
            <h1 class="mb-5 text-2xl font-bold sm:text-3xl md:text-4xl text-primary-800 sm:mb-10">
                {{ __('partners.institutional') }}
            </h1>

            <div class="grid gap-2 sm:gap-5 sm:grid-cols-2 md:grid-cols-4">
                @foreach ($institutions as $institution)
                    <x-partners.institution
                        :name="data_get($institution, 'name')"
                        :logo="data_get($institution, 'logo')"
                        :url="data_get($institution, 'url')" />
                @endforeach
            </div>
        </section>
    @endif

    @if (filled($experts))
        <section class="container relative max-w-6xl mt-8 mb-32 sm:mb-40">
            <h1 class="mb-5 text-2xl font-bold sm:text-3xl md:text-4xl text-primary-800 sm:mb-10">
                {{ __('partners.experts') }}
            </h1>

            <div class="grid gap-2 gap-y-10 sm:gap-x-5 sm:grid-cols-2 md:grid-cols-4">
                @foreach ($experts as $expert)
                    <x-partners.expert
                        :name="data_get($expert, 'name')"
                        :title="data_get($expert, 'title')"
                        :country="data_get($expert, 'country')"
                        :avatar="data_get($expert, 'avatar')"
                        :links="data_get($expert, 'links')" />
                @endforeach
            </div>
        </section>
    @endif

</div>
