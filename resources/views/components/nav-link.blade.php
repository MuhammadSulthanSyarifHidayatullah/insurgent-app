@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white transition duration-150 ease-in-out'
            : 'inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
