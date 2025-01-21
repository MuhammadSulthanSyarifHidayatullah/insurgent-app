<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Partisan' }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{-- @include('layouts.admin-sidebar') --}}
        <div x-data="{ open: false }" class="flex h-screen bg-gray100">
            <!-- Sidebar -->
            <div :class="open ? 'block' : 'hidden' + ' md:flex fixed min-h-screen'"
                class="flex-col justify-between border-e bg-white w-64 md:block">
                <div class="px-4 py-6">
                    <a href="{{ route('dashboard') }}">
                        <x-application-smalllogo class="grid place-content-center"></x-application-smalllogo>
                    </a>

                    <ul class="mt-6 space-y-1">
                        <li>
                            <x-sidebar-link :href="route('statistics')" :active="request()->routeIs('statistics')">
                                <i class="fa-solid fa-chart-line pr-2"></i>
                                {{ __('Statistics') }}
                            </x-sidebar-link>
                        </li>
                        <li>
                            <x-sidebar-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">
                                <i class="fa-solid fa-bag-shopping pr-2"></i>
                                {{ __('Product') }}
                            </x-sidebar-link>
                        </li>
                        <li>
                            <x-sidebar-link :href="route('invoice.index')" :active="request()->routeIs('invoice.index')">
                                <i class="fa-solid fa-file-invoice pr-2"></i>
                                {{ __('Invoice') }}
                            </x-sidebar-link>
                        </li>
                        <li>
                            <a href="#"
                                class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                                Account
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="sticky inset-x-0 bottom-0 border-t border-gray-100">
                    <div class="text-gray-500">
                        <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"
                            class="m-2 mb-4 p-3 py-3 bg-gray-50 hover:bg-gray-100">
                            <i class="fa-solid fa-user fa-lg px-2"></i>
                            {{ Auth::user()->name }}
                        </x-sidebar-link>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div :class="open ? 'hidden' : 'block'" class="fixed">
                <!-- Toggle button for mobile -->
                <button @click="open = !open" class="md:hidden p-2 mb-4 bg-gray-200 rounded-full focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Page Content -->

            <main class="flex-1 p-10 pl-64">
                {{ $slot }}
            </main>
        </div>
</body>

</html>
