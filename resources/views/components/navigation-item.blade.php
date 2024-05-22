@props(['mobile' => false])

<a
    {{ $attributes->merge([
            'href' => localizedRoute($route),
            'wire:navigate' => true,
        ])->class([
            'font-medium leading-tight',
            'text-blue-900 hover:bg-blue-50',
            $isCurrent() ? 'bg-blue-50' : '',
            $mobile ? 'flex px-2 py-3' : 'px-3 py-2 rounded',
        ]) }}>
    {{ $label }}
</a>
