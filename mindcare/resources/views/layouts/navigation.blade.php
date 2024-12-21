<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    <!-- You can replace this text with an image logo if you want -->
                    MyWebsite
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex space-x-4 items-center">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-800 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-300">
                    {{ __('Home') }}
                </x-nav-link>

                <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="text-gray-800 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-300">
                    {{ __('Profile') }}
                </x-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-800 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-300">
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="block text-gray-800 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-300">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="block text-gray-800 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-300">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block text-gray-800 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-300">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
