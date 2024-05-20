<a
    {{ $attributes->merge([
            'href' => localizedRoute($route),
        ])->class([
            'px-5 py-3 rounded-xl',
            'text-lg font-medium leading-tight',
            'text-blue-900 hover:bg-blue-50',
            $isCurrent() ? 'bg-blue-50' : '',
        ]) }}>
    {{ $label }}
</a>
