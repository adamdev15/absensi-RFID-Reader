<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('storage/' . setting('app_logo')) }}" type="image/png" class="rounded-lg">


        <title>{{ app_name() }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800 bg-slate-50">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
            <!-- Sidebar Desktop & Mobile -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
                <!-- Header -->
                @include('layouts.header')

                <!-- Main Content -->
                <main class="w-full grow p-6">
                    <!-- Page Heading (Breadcrumb style) -->
                    @isset($header)
                        <div class="mb-6">
                            {{ $header }}
                        </div>
                    @endisset

                    <!-- Page Slot -->
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
