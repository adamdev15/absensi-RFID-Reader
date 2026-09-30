<!-- Sidebar Backdrop (Mobile) -->
<div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-slate-900 bg-opacity-50 lg:hidden" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

<!-- Sidebar -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="absolute z-50 flex flex-col w-64 h-screen overflow-y-auto transition-transform duration-300 ease-in-out bg-white border-r border-slate-200 lg:static lg:translate-x-0">
    <!-- Header Sidebar -->
    <div class="flex items-center justify-center h-20 px-6 m-3">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            @if(setting('app_logo'))
                <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo" class="h-10 w-auto rounded-lg">
            @else
                <div class="flex items-center justify-center w-10 h-10 font-bold text-white rounded-lg bg-primary-700">
                    NU
                </div>
            @endif
            <div class="flex flex-col">
                <span class="text-sm font-bold text-slate-900 leading-tight">{{ setting('app_organization', 'PCNU Kab. Tegal') }}</span>
                <span class="text-xs text-slate-500">{{ setting('app_name', 'Sistem Absensi') }}</span>
            </div>
        </a>
    </div>

    <!-- Menus -->
    <nav class="flex flex-col gap-1 p-4">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Dashboard
        </a>

        <!-- MASTER DATA -->
        @canany(['participants.view', 'utusan.manage', 'positions.manage', 'mwcnu.manage'])
            <div class="mt-4 mb-2 text-xs font-semibold tracking-wider uppercase text-slate-400 px-3">Master Data</div>
            
            @can('participants.view')
            <a href="{{ route('participants.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('participants.*') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Peserta
            </a>
            @endcan

            @can('utusan.manage')
            <a href="{{ route('utusan.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('utusan.*') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Utusan
            </a>
            @endcan

            @can('positions.manage')
            <a href="{{ route('positions.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('positions.*') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Jabatan
            </a>
            @endcan

            @can('mwcnu.manage')
            <a href="{{ route('mwcnu.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('mwcnu.*') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                MWCNU
            </a>
            @endcan
        @endcanany

        <!-- ABSENSI -->
        @canany(['rfid.view', 'stations.view', 'logs.view'])
            <div class="mt-4 mb-2 text-xs font-semibold tracking-wider uppercase text-slate-400 px-3">Absensi</div>
            
            @can('rfid.view')
            <a href="{{ route('rfid.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('rfid.*') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                Monitoring RFID
            </a>
            @endcan

            @can('stations.view')
            <a href="{{ route('stations.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('stations.*') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Monitoring Station
            </a>
            @endcan
            @can('reports.view')
            <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('reports.*') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Log Absensi
            </a>
        @endcan
        @endcanany

        <!-- SYSTEM -->
        @canany(['settings.view', 'backup.create'])
            <div class="mt-4 mb-2 text-xs font-semibold tracking-wider uppercase text-slate-400 px-3">System</div>
            
            @can('settings.view')
            <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('settings.*') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Pengaturan
            </a>
            @endcan

            @can('backup.create')
            <a href="{{ route('backup.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('backup.*') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Backup & Restore
            </a>
            @endcan
        @endcanany
    </nav>
</aside>
