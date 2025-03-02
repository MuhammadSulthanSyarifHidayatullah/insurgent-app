<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Partisan' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html,
        body {
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased h-full">
    <div class="lg:grid lg:h-full lg:grid-cols-12 bg-gray-100">
        <aside class="relative hidden lg:block lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
            <img alt="" src="{{ asset('images/auth-image.jpeg') }}"
                class="absolute inset-0 h-full w-full object-cover" />
        </aside>
        <main class="flex items-center justify-center px-8 py-2 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
