<x-app-layout>
    @section('title', 'Pengaturan Aplikasi')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">System</span>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Pengaturan</span>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-4xl mx-auto">
        <div class="card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h3 class="font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Branding & Konfigurasi Aplikasi
                </h3>
            </div>
            
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- App Name -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Aplikasi Utama <span class="text-red-500">*</span></label>
                            <input type="text" name="app_name" value="{{ old('app_name', $settings['app_name'] ?? 'Absensi PCNU') }}" class="form-input" required>
                            <p class="mt-1 text-xs text-slate-500">Tampil di judul halaman dan header.</p>
                        </div>
                        <!-- Organisasi -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Organisasi <span class="text-red-500">*</span></label>
                            <input type="text" name="app_organization" value="{{ old('app_organization', $settings['app_organization'] ?? 'PCNU Kabupaten Tegal') }}" class="form-input" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                        <!-- Logo -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Logo Aplikasi (Header / Navbar)</label>
                            @if(isset($settings['app_logo']) && $settings['app_logo'])
                                <div class="mb-3 bg-slate-50 p-2 inline-block rounded border border-slate-200">
                                    <img src="{{ asset('storage/' . $settings['app_logo']) }}" class="h-12 object-contain" alt="Logo">
                                </div>
                            @endif
                            <input type="file" name="app_logo" accept="image/*" class="form-input !p-1.5 bg-white">
                            <p class="mt-1 text-xs text-slate-500">Format: PNG transparan (Rekomendasi ukuran tinggi 80px).</p>
                        </div>
                        
                        <!-- Hero Image Landing -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Gambar Banner / Hero (Halaman Utama)</label>
                            @if(isset($settings['hero_image']) && $settings['hero_image'])
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $settings['hero_image']) }}" class="h-20 w-32 object-cover rounded border border-slate-200" alt="Hero">
                                </div>
                            @endif
                            <input type="file" name="hero_image" accept="image/*" class="form-input !p-1.5 bg-white">
                            <p class="mt-1 text-xs text-slate-500">Gambar ilustrasi atau kegiatan (Rekomendasi rasio 16:9 HD).</p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Teks Sambutan Halaman Landing</label>
                        <textarea name="landing_welcome_text" rows="3" class="form-input">{{ old('landing_welcome_text', $settings['landing_welcome_text'] ?? 'Selamat datang di Sistem Informasi Absensi Digital PCNU Kabupaten Tegal. Silakan login untuk melanjutkan.') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                        <!-- Admin Contact -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Kontak Bantuan (Email / WA)</label>
                            <input type="text" name="support_contact" value="{{ old('support_contact', $settings['support_contact'] ?? 'admin@pcnu-tegal.or.id') }}" class="form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Versi Aplikasi</label>
                            <input type="text" name="app_version" value="{{ old('app_version', $settings['app_version'] ?? 'v1.0.0') }}" class="form-input bg-slate-50">
                        </div>
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-slate-200">
                    <button type="submit" class="btn-primary flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
