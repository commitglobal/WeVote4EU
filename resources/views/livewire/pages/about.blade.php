<div class="px-6 py-32 lg:px-8">
    <div
        class="max-w-3xl mx-auto prose text-gray-700 md:prose-lg lg:prose-xl prose-a:text-primary-500 prose-a:font-medium hover:prose-a:no-underline prose-headings:text-primary-500">
        <h1>{!! Str::inlineMarkdown(__('about.title')) !!}</h1>

        {!! Str::markdown(__('about.intro_1')) !!}
        {!! Str::markdown(__('about.intro_2')) !!}

        <h2>{!! Str::inlineMarkdown(__('about.subtitle_1')) !!}</h2>
        {!! Str::markdown(__('about.line_1_1')) !!}
        {!! Str::markdown(__('about.line_1_2')) !!}

        <h2>{!! Str::inlineMarkdown(__('about.subtitle_2')) !!}</h2>
        {!! Str::markdown(__('about.line_2_1')) !!}
        {!! Str::markdown(__('about.line_2_2')) !!}
        {!! Str::markdown(__('about.line_2_3')) !!}
        {!! Str::markdown(__('about.line_2_4')) !!}
        {!! Str::markdown(__('about.line_2_5')) !!}

        <h2>{!! Str::inlineMarkdown(__('about.subtitle_3')) !!}</h2>
        {!! Str::markdown(__('about.line_3_1')) !!}

        <h2>{!! Str::inlineMarkdown(__('about.subtitle_4')) !!}</h2>
        {!! Str::markdown(__('about.line_4_1')) !!}

        <h2>{!! Str::inlineMarkdown(__('about.subtitle_5')) !!}</h2>
        {!! Str::markdown(__('about.line_5_1')) !!}
        {!! Str::markdown(__('about.line_5_2')) !!}

    </div>
</div>
