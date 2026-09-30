<x-app-layout>
    @section('title', 'Data Peserta')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Data Peserta</span>
        </div>
    </x-slot>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Top Bar: Search & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <form method="GET" action="{{ route('participants.index') }}" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="form-input pl-10 h-10 w-full sm:w-64" placeholder="Cari nama atau kode...">
            </div>
            
            <select name="utusan_id" class="form-input h-10 w-full sm:w-48 text-slate-600">
                <option value="">Semua Utusan</option>
                @foreach($utusanList as $utusan)
                    <option value="{{ $utusan->id }}" {{ request('utusan_id') == $utusan->id ? 'selected' : '' }}>{{ $utusan->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn-secondary h-10 px-4">Filter</button>
            
            @if(request()->hasAny(['search', 'utusan_id', 'status']))
                <a href="{{ route('participants.index') }}" class="btn-secondary h-10 px-4 flex items-center text-red-600 border-red-200 hover:bg-red-50">Reset</a>
            @endif
        </form>

        <a href="{{ route('participants.create') }}" class="btn-primary h-10 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Peserta
        </a>
    </div>

    <!-- Table Card -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-semibold text-slate-500 tracking-wider">
                        <th class="px-6 py-4">Peserta</th>
                        <th class="px-6 py-4">Kode</th>
                        <th class="px-6 py-4">Utusan & Jabatan</th>
                        <th class="px-6 py-4">RFID</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm">
                    @forelse ($participants as $p)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($p->photo_url)
                                        <img src="{{ $p->photo_url }}" class="w-10 h-10 rounded-full object-cover border border-slate-200" alt="{{ $p->name }}">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold border border-primary-200">
                                            {{ substr($p->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-slate-900">{{ $p->name }}</div>
                                        <div class="text-slate-500 text-xs">{{ $p->mwcnu?->name ?? $p->organization ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 font-medium">
                                {{ $p->participant_code }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-900">{{ $p->utusan?->name ?? '-' }}</div>
                                <div class="text-slate-500 text-xs">{{ $p->jabatan?->name ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($p->activeRfidCard())
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Tersambung
                                    </span>
                                    <div class="text-xs text-slate-400 mt-1 uppercase">{{ $p->activeRfidCard()->uid }}</div>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        Tidak Ada
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $p->isActive() ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                                    {{ $p->status->label() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('participants.show', $p->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="{{ route('participants.edit', $p->id) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('participants.destroy', $p->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini? Semua akses RFID akan otomatis dicabut.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p>Tidak ada data peserta ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($participants->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $participants->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
