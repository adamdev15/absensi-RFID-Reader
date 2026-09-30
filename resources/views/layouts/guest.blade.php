<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('storage/' . setting('app_logo')) }}" type="image/png">

    <title>{{ setting('app_name', config('app.name', 'Laravel')) }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 antialiased bg-slate-50 relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 overflow-hidden">
    
    <!-- Decorative Background Shapes -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[500px] h-[500px] rounded-full bg-primary-100 blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[400px] h-[400px] rounded-full bg-blue-50 blur-3xl opacity-50"></div>
    </div>

    <!-- Login Container -->
    <div class="relative z-10 w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-xl sm:rounded-2xl border border-slate-100">
        
        <!-- Logo & Branding -->
        <div class="flex flex-col items-center justify-center mb-8">
            <a href="/" class="mb-4">
                @if(setting('app_logo'))
                    <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo" class="h-16 w-auto rounded-lg">
                @else
                    <div class="flex items-center justify-center w-14 h-14 font-bold text-white text-xl rounded-xl bg-primary-700 shadow-md">
                        NU
                    </div>
                @endif
            </a>
            <h2 class="text-2xl font-bold text-slate-900 text-center">{{ setting('app_name', 'Sistem Absensi') }}</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">{{ setting('app_organization', 'PCNU Kabupaten Tegal') }}</p>
        </div>

        {{ $slot }}

    </div>

    <!-- Footer -->
    <div class="relative z-10 mt-8 text-center text-sm text-slate-500">
        &copy; {{ date('Y') }} {{ setting('app_organization', 'PCNU Kabupaten Tegal') }}
    </div>
</body>
</html>
