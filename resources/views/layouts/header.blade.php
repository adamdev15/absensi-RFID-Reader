<header class="flex items-center justify-between h-20 px-6 bg-white border-b border-slate-200">
    <!-- Left: Mobile Menu & Title -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="p-2 -ml-2 text-slate-500 rounded-lg lg:hidden hover:bg-slate-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
        <h2 class="text-xl font-semibold text-slate-800">
            @yield('title', 'Dashboard')
        </h2>
    </div>

    <!-- Right: Profile & Notifications -->
    <div class="flex items-center gap-4 m-3">
        <!-- Notification -->
        <button class="relative p-2 text-slate-400 rounded-full hover:bg-slate-100 hover:text-slate-600">
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        </button>

        <!-- User Dropdown -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center gap-2 p-2 text-sm font-medium transition duration-150 ease-in-out rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none focus:bg-slate-100">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ml-1">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
                                        this.closest('form').submit();"
                            class="text-red-600 hover:bg-red-50">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
