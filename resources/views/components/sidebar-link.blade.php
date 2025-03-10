@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700'
            : 'block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
