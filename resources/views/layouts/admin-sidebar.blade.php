<div x-data="{ open: false }" class="flex h-screen bg-gray100">
    <!-- Sidebar -->
    <div :class="open ? 'block' : 'hidden' + ' md:flex'"
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
                    <a href="#"
                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        Invoices
                    </a>
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
                <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="m-2 mb-4 p-3 py-3 bg-gray-50 hover:bg-gray-100">
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
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>
