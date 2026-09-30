<x-app-layout>
    @section('title', 'Laporan Absensi')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Laporan Absensi</span>
        </div>
    </x-slot>

    <!-- Filter Card -->
    <div class="card p-6 mb-6">
        <form action="{{ route('reports.index') }}" method="GET" class="flex flex-col lg:flex-row items-end gap-4">
            
            <div class="w-full lg:w-1/4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-input w-full">
            </div>
            
            <div class="w-full lg:w-1/4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Station</label>
                <select name="station_id" class="form-input w-full">
                    <option value="">Semua Station</option>
                    @foreach(\App\Models\Station::all() as $st)
                        <option value="{{ $st->id }}" {{ request('station_id') == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full lg:w-1/4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Tipe Absen</label>
                <select name="type" class="form-input w-full">
                    <option value="">Semua Tipe</option>
                    <option value="IN" {{ request('type') == 'IN' ? 'selected' : '' }}>Masuk (IN)</option>
                    <option value="OUT" {{ request('type') == 'OUT' ? 'selected' : '' }}>Keluar (OUT)</option>
                </select>
            </div>

            <div class="w-full lg:w-1/4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Cari Peserta</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama / Kode..." class="form-input w-full">
            </div>

            <div class="flex gap-2 w-full lg:w-auto">
                <button type="submit" class="btn-primary w-full lg:w-auto flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Filter
                </button>
                <a href="{{ route('reports.index') }}" class="btn-secondary w-full lg:w-auto flex items-center justify-center">Reset</a>
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="card overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
            <h3 class="font-semibold text-slate-800">Data Rekap Absensi</h3>
            <form action="{{ route('reports.export') }}" method="POST">
                @csrf
                <button type="submit" class="btn-secondary flex items-center gap-2 text-sm py-1.5">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export Excel
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Peserta</th>
                        <th>Kategori / MWCNU</th>
                        <th>Tipe</th>
                        <th>Station</th>
                        <th class="text-center">Foto Snapshot</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($attendances as $attendance)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-slate-900">{{ \Carbon\Carbon::parse($attendance->attendance_at)->format('H:i:s') }}</div>
                                <div class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($attendance->attendance_at)->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-primary-700">{{ $attendance->participant?->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-slate-500">{{ $attendance->participant?->participant_code ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-700">{{ $attendance->participant?->utusan?->name ?? '-' }}</div>
                                <div class="text-xs text-slate-500">{{ $attendance->participant?->mwcnu?->name ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($attendance->type->value === 'IN')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                        MASUK
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        KELUAR
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $attendance->station_name_snapshot ?? ($attendance->station?->name ?? '-') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($attendance->capture_path)
                                    <a href="{{ asset('storage/' . $attendance->capture_path) }}" target="_blank" class="inline-block p-1 bg-white border border-slate-200 rounded hover:border-primary-500 transition-colors">
                                        <img src="{{ asset('storage/' . $attendance->capture_path) }}" class="h-10 w-12 object-cover rounded-sm" alt="Snapshot">
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400 italic">Tidak ada foto</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p>Belum ada data absensi yang sesuai dengan kriteria filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-slate-100 bg-white">
            {{ $attendances->links() }}
        </div>
    </div>
</x-app-layout>
