@props(['active'])

@php
$classes = ($active ?? false)
            ? 'relative inline-flex items-center rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white transition duration-150 ease-in-out'
            : 'relative inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}

    {{-- Notification Dot --}}
        <span class="absolute top-0 right-0 flex h-3 w-3 transform translate-x-1/4 -translate-y-1/4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-500 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
        </span>
</a>
