@props(['variant' => 'primary'])

@php
$classes = 'inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150';
$variantClasses = [
    'primary' => 'text-white bg-gray-600 hover:bg-gray-700 focus:ring-gray-500',
    'secondary' => 'text-gray-700 bg-white hover:bg-gray-200 focus:ring-gray-500',
];
@endphp

<a {{ $attributes->merge(['class' => $classes . ' ' . $variantClasses[$variant]]) }}>
    {{ $slot }}
</a>