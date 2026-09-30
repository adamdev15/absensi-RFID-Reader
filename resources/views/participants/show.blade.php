<x-app-layout>
    @section('title', 'Detail Peserta')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('participants.index') }}" class="hover:text-primary-700">Data Peserta</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">{{ $participant->name }}</span>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri: Profil Singkat & Status -->
        <div class="lg:col-span-1 flex flex-col gap-6">
            <div class="card p-6 flex flex-col items-center text-center">
                @if($participant->photo_url)
                    <img src="{{ $participant->photo_url }}" class="w-32 h-32 rounded-full object-cover border-4 border-slate-100 shadow-sm mb-4" alt="{{ $participant->name }}">
                @else
                    <div class="w-32 h-32 rounded-full bg-primary-50 flex items-center justify-center text-primary-700 font-bold text-4xl border-4 border-primary-100 mb-4">
                        {{ substr($participant->name, 0, 1) }}
                    </div>
                @endif
                
                <h2 class="text-xl font-bold text-slate-900">{{ $participant->name }}</h2>
                <p class="text-slate-500 font-mono mt-1 bg-slate-100 px-2 py-0.5 rounded text-sm">{{ $participant->participant_code }}</p>

                <div class="mt-4 flex gap-2">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $participant->isActive() ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                        {{ $participant->status->label() }}
                    </span>
                    @if($participant->activeRfidCard())
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                            RFID: {{ $participant->activeRfidCard()->uid }}
                        </span>
                    @endif
                </div>

                <div class="mt-6 w-full flex flex-col gap-2">
                    <a href="{{ route('participants.edit', $participant->id) }}" class="btn-secondary w-full text-center">Edit Data Peserta</a>
                </div>
            </div>

            <!-- Kartu Utusan -->
            <div class="card p-6">
                <h3 class="font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Informasi Delegasi
                </h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between py-2 border-b border-slate-100">
                        <span class="text-slate-500">Kategori Utusan</span>
                        <span class="font-medium text-slate-900">{{ $participant->utusan?->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-slate-100">
                        <span class="text-slate-500">Jabatan</span>
                        <span class="font-medium text-slate-900">{{ $participant->jabatan?->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-slate-100">
                        <span class="text-slate-500">MWCNU</span>
                        <span class="font-medium text-slate-900">{{ $participant->mwcnu?->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-slate-500">Lembaga/Banom</span>
                        <span class="font-medium text-slate-900">{{ $participant->organization ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Detail & Riwayat -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            
            <!-- Detail Personal & Dokumen -->
            <div class="card p-6">
                <h3 class="font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Informasi Personal
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 text-sm mb-8">
                    <div>
                        <span class="block text-slate-500 mb-1">Tempat, Tanggal Lahir</span>
                        <span class="font-medium text-slate-900">
                            {{ $participant->birth_place ?? '-' }}, 
                            {{ $participant->birth_date ? $participant->birth_date->format('d/m/Y') : '-' }}
                        </span>
                    </div>
                    <div>
                        <span class="block text-slate-500 mb-1">Jenis Kelamin</span>
                        <span class="font-medium text-slate-900">
                            @if($participant->gender == 'L') Laki-laki
                            @elseif($participant->gender == 'P') Perempuan
                            @else - @endif
                        </span>
                    </div>
                    <div>
                        <span class="block text-slate-500 mb-1">Waktu Pendaftaran</span>
                        <span class="font-medium text-slate-900">{{ $participant->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-500 mb-1">Surat Mandat</span>
                        @if($participant->mandate_letter_url)
                            <a href="{{ $participant->mandate_letter_url }}" target="_blank" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-800 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                Lihat Dokumen
                            </a>
                        @else
                            <span class="font-medium text-slate-400">Tidak ada</span>
                        @endif
                    </div>
                </div>

                <h3 class="font-semibold text-slate-800 mb-4 flex items-center gap-2 border-t border-slate-100 pt-6">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Riwayat Absensi Terakhir
                </h3>
                
                @if($participant->attendances->count() > 0)
                    <div class="relative pl-4 border-l-2 border-slate-200 space-y-6">
                        @foreach($participant->attendances as $attendance)
                            <div class="relative">
                                <div class="absolute -left-[21px] bg-white p-1">
                                    <div class="w-2.5 h-2.5 rounded-full {{ $attendance->type->value == 'IN' ? 'bg-green-500' : 'bg-blue-500' }}"></div>
                                </div>
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-slate-900 text-sm">
                                            Absen {{ $attendance->type->value == 'IN' ? 'Masuk' : 'Keluar' }}
                                        </p>
                                        <p class="text-slate-500 text-xs mt-0.5">
                                            Station: {{ $attendance->station_name_snapshot }}
                                        </p>
                                    </div>
                                    <span class="text-xs font-medium text-slate-500">
                                        {{ \Carbon\Carbon::parse($attendance->attendance_at)->format('d M Y, H:i:s') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6 text-slate-500 text-sm bg-slate-50 rounded-lg border border-slate-100">
                        Belum ada riwayat absensi.
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>
