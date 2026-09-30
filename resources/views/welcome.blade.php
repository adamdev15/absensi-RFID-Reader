<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ setting('app_name', 'Absensi PCNU') }}</title>
    <link rel="icon" href="{{ asset('storage/' . setting('app_logo')) }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-slate-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-4">
                    @if(setting('app_logo'))
                        <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo" class="h-12 w-auto rounded-lg">
                    @else
                        <div class="flex items-center justify-center w-10 h-10 font-bold text-white rounded-lg bg-primary-700">
                            NU
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span class="text-lg font-bold text-slate-900 leading-tight">{{ setting('app_organization', 'PCNU Kabupaten Tegal') }}</span>
                        <span class="text-sm text-slate-500 font-medium">{{ setting('app_name', 'Sistem Absensi Digital') }}</span>
                    </div>
                </div>
                <div class="flex items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary">Ke Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">Log in Sistem</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center bg-white relative overflow-hidden">
        <!-- Background Pattern/Image -->
        <div class="absolute inset-0 z-0">
            @if(setting('hero_image'))
                <img src="{{ asset('storage/' . setting('hero_image')) }}" alt="Hero Background" class="w-full h-full object-cover opacity-10">
                <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 to-transparent"></div>
            @else
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+CgkJPGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNlMmU4ZjAiIGZpbGwtb3BhY2l0eT0iMC40Ii8+Cjwvc3ZnPg==')] opacity-60"></div>
                <!-- Gradient decoration -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-primary-100 blur-3xl opacity-50"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-50 blur-3xl opacity-50"></div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full py-20 lg:py-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold mb-6 border border-primary-100">
                        <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
                        {{ setting('app_version', 'v1.0.0') }}
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight mb-6">
                        Sistem Informasi <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800">
                            Absensi Digital Terpadu
                        </span>
                    </h1>
                    <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                        {{ setting('landing_welcome_text', 'Selamat datang di Sistem Informasi Absensi Digital PCNU Kabupaten Tegal. Platform modern untuk manajemen kehadiran pengurus, utusan, dan tamu undangan berbasis RFID.') }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary text-center py-3 px-8 text-base shadow-lg shadow-primary-500/30">Masuk ke Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-primary text-center py-3 px-8 text-base shadow-lg shadow-primary-500/30">Log in Administrator</a>
                        @endauth
                        <a href="#features" class="btn-secondary text-center py-3 px-8 text-base">Pelajari Fitur</a>
                    </div>
                </div>

                <!-- Illustration (Optional) -->
                <div class="hidden lg:flex justify-center relative">
                    <div class="w-[500px] h-[400px] bg-white rounded-2xl shadow-2xl border border-slate-100 p-6 flex flex-col transform rotate-2 hover:rotate-0 transition-transform duration-500">
                        <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-4">
                            <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800">Scan RFID Verification</h3>
                                <p class="text-xs text-slate-500">Realtime & Offline Queue</p>
                            </div>
                            <div class="ml-auto text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded">RFID Reader</div>
                        </div>
                        <div class="flex-grow rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center relative overflow-hidden">
                             <!-- Dummy scanning animation -->
                             <div class="w-full h-1 bg-primary-500 absolute top-0 animate-[scan_2s_ease-in-out_infinite] shadow-[0_0_10px_#15803D]"></div>
                             <img src="{{ asset('storage/' . setting('hero_image')) }}" alt="Hero Background" class="w-full h-full object-cover opacity-9">
                        </div>
                        <div class="mt-4 flex gap-2">
                            <div class="h-2 w-16 bg-green-200 rounded-full"></div>
                            <div class="h-2 w-24 bg-green-100 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} {{ setting('app_organization', 'PCNU Kabupaten Tegal') }}. Hak Cipta Dilindungi.
            </p>
            <p class="text-slate-400 text-sm">
                Versi {{ setting('app_version', '1.0.0') }}
            </p>
        </div>
    </footer>

    <style>
        @keyframes scan {
            0% { top: 0; }
            50% { top: 100%; }
            100% { top: 0; }
        }
    </style>
</body>
</html>
