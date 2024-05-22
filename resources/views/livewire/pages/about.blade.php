<div class="px-6 py-32 lg:px-8">
    <div
        class="max-w-3xl mx-auto prose text-gray-700 md:prose-lg lg:prose-xl prose-a:text-primary-500 prose-a:font-medium hover:prose-a:no-underline prose-headings:text-primary-500">
        <h1>{!! Str::inlineMarkdown(__('about.title')) !!}</h1>

        {!! Str::markdown(__('about.line_1')) !!}
        {!! Str::markdown(__('about.line_2')) !!}

        <h2>{!! Str::inlineMarkdown(__('about.subtitle')) !!}</h2>

        {!! Str::markdown(__('about.line_3')) !!}
        {!! Str::markdown(__('about.line_4')) !!}
        {!! Str::markdown(__('about.line_5')) !!}
        {!! Str::markdown(__('about.line_6')) !!}
        {!! Str::markdown(__('about.line_7')) !!}
        {!! Str::markdown(__('about.line_8')) !!}
    </div>
</div>
