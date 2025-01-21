<nav x-data="{ open: false }" class="bg-gray-800 sticky top-0 z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 items-center">
        <div class="flex justify-between h-16">
            <!-- Left Side (Logo) -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img class="block h-9 w-auto fill-current text-gray-800"
                        src="{{ asset('images/smalllogowhite.png') }}" />
                </a>
            </div>

            <!-- Middle Side (Navigation Links) -->
            <div class="flex-grow flex justify-center left-7">
                <div class="hidden space-x-8 sm:-my-px sm:flex content-center">
                    <div class="content-center">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                            {{ __('About Us') }}
                        </x-nav-link>
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                            {{ __('Product') }}
                        </x-nav-link>
                        @role('admin')
                            <x-admin-nav :href="route('statistics')" :active="request()->routeIs('statistics')">
                                {{ __('Admin Menu') }}
                            </x-admin-nav>
                        @endrole
                    </div>
                </div>
            </div>

            <!-- Right Side (Login/Register or Profile) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <a href="{{ route('cart.index') }}" class="relative">
                    <span style="color: #d1d5db">
                        <i class="fa-solid fa-cart-shopping fa-lg"></i>
                    </span>
                    @if (session('cartItemCount', 0) > 0)
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ session('cartItemCount') }}
                        </span>
                    @endif
                </a>

                @guest
                    <div class="gap-2">
                        <a href="{{ route('login') }}">
                            <x-secondary-button class="border-gray-800 border-[1.5px]">Login <i
                                    class=" ml-2 fa-solid fa-arrow-right"></i></x-secondary-button>
                        </a>
                    </div>
                @endguest

                @auth
                    <!-- If the user is logged in -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <i class="fa-solid fa-user fa-lg px-2"></i>
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')" class="relative inline-block">
                {{ __('Cart') }}
                @if (session('cartItemCount', 0) > 0)
                    <span
                        class="absolute top-0 right-0 -mt-1 -mr-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ session('cartItemCount') }}
                    </span>
                @endif
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @guest
                <div class="px-4 flex justify-center mb-2">
                    <a href="{{ route('login') }}">
                        <x-primary-button>Login</x-primary-button>
                    </a>
                    <a href="{{ route('register') }}">
                        <x-secondary-button class="border-gray-800 border-[1.5px]">Register</x-secondary-button>
                    </a>
                </div>
            @endguest

            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
