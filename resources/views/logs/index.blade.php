<x-app-layout>
    @section('title', 'Log Aktivitas')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Log Aktivitas</span>
        </div>
    </x-slot>

    <div class="card p-6">
        <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">
            <h3 class="font-semibold text-slate-800 text-lg">Catatan Aktivitas Pengguna</h3>
            
            <form action="{{ route('logs.index') }}" method="GET" class="w-full sm:w-1/3 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aktivitas..." class="form-input w-full pl-10">
                <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th class="w-24">Waktu</th>
                        <th class="w-48">Pengguna</th>
                        <th class="w-32">Modul</th>
                        <th>Aktivitas</th>
                        <th class="w-32">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $log->created_at->format('d/m/Y') }}<br>
                                <span class="text-xs text-slate-400">{{ $log->created_at->format('H:i:s') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-900">{{ $log->user?->name ?? 'System' }}</div>
                                <div class="text-xs text-slate-500">{{ $log->user?->role ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $log->module ?? 'Sistem' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">{{ $log->action }}</div>
                                <div class="text-xs text-slate-500 mt-1">{{ $log->description }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $log->ip_address ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                Tidak ada data aktivitas ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</x-app-layout>
