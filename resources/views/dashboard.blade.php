<x-app-layout>
    @section('title', 'Dashboard')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <span class="text-primary-700 font-medium">Beranda</span>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span>Dashboard</span>
        </div>
    </x-slot>

    <!-- Welcome Card -->
    <div class="p-6 mb-6 bg-white border border-slate-200 rounded-xl shadow-sm">
        <h3 class="text-lg font-semibold text-slate-800">Selamat datang kembali, {{ Auth::user()->name }}!</h3>
        <p class="text-slate-500 mt-1">Berikut adalah ringkasan aktivitas absensi hari ini.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 mb-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Card: Total Peserta -->
        <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Peserta</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">{{ number_format($totalPeserta) }}</p>
                </div>
                <div class="p-3 bg-primary-50 rounded-lg text-primary-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card: RFID Terdaftar -->
        <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">RFID Terdaftar</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">{{ number_format($rfidTerdaftar) }}</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card: Station Online -->
        <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Station Online</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">{{ $stationOnline }} <span class="text-sm font-normal text-slate-400">/ {{ $totalStation }}</span></p>
                </div>
                <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card: Absensi Hari Ini -->
        <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Absensi Hari Ini</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">{{ number_format($absensiHariIni) }}</p>
                </div>
                <div class="p-3 bg-amber-50 rounded-lg text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table Placeholder -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
            <h3 class="font-semibold text-slate-800">Aktivitas Absensi Terkini</h3>
            <span class="flex items-center text-xs font-medium text-primary-600 bg-primary-50 px-2 py-1 rounded-full">
                <span class="w-1.5 h-1.5 bg-primary-500 rounded-full mr-1.5 animate-pulse"></span>
                LIVE
            </span>
        </div>
        @if($recentAttendances->count() > 0)
        <div class="overflow-x-auto">
            <table class="table-custom w-full">
                <thead>
                    <tr>
                        <th class="text-left px-6 py-3">Waktu</th>
                        <th class="text-left px-6 py-3">Peserta</th>
                        <th class="text-left px-6 py-3">Kategori / MWCNU</th>
                        <th class="text-left px-6 py-3">Tipe</th>
                        <th class="text-left px-6 py-3">Station</th>
                        <th class="text-center px-6 py-3">Foto Snapshot</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentAttendances as $attendance)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($attendance->attendance_at)->format('H:i:s') }}</div>
                                <div class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($attendance->attendance_at)->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-primary-700">{{ $attendance->participant_name_snapshot ?? ($attendance->participant?->name ?? 'Unknown') }}</div>
                                <div class="text-xs text-slate-500">{{ $attendance->participant_code_snapshot ?? ($attendance->participant?->participant_code ?? '-') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-700">{{ $attendance->utusan_name_snapshot ?? ($attendance->participant?->utusan?->name ?? '-') }}</div>
                                <div class="text-xs text-slate-500">{{ $attendance->mwcnu_name_snapshot ?? ($attendance->participant?->mwcnu?->name ?? '-') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($attendance->type->value === 'IN')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        MASUK
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                        KELUAR
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $attendance->station_name_snapshot ?? ($attendance->station?->name ?? '-') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($attendance->capture_path)
                                    <a href="{{ asset('storage/' . $attendance->capture_path) }}" target="_blank" class="inline-block p-1 bg-white border border-slate-200 rounded">
                                        <img src="{{ asset('storage/' . $attendance->capture_path) }}" class="h-10 w-12 object-cover rounded-sm">
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400 italic">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="p-6 text-center text-slate-500">
            <p>Data absensi belum tersedia untuk hari ini.</p>
        </div>
        @endif
    </div>
</x-app-layout>
