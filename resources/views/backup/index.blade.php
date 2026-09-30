<x-app-layout>
    @section('title', 'Backup & Restore Database')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">System</span>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Backup & Restore</span>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- Action Card -->
        <div class="card p-6 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="font-bold text-slate-800 text-lg mb-1">Pencadangan Sistem (Backup)</h3>
                <p class="text-sm text-slate-500 max-w-2xl">Lakukan pencadangan database secara rutin untuk menghindari kehilangan data akibat kerusakan server atau kegagalan perangkat keras.</p>
            </div>
            
            <form action="{{ route('backup.create') }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary flex items-center gap-2 whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Buat Backup Baru
                </button>
            </form>
        </div>

        <!-- History Card -->
        <div class="card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <h3 class="font-semibold text-slate-800">Riwayat Backup</h3>
            </div>
            
            <div class="p-6">
                @if(count($backups) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($backups as $backup)
                            <div class="border border-slate-200 rounded-xl p-4 hover:border-primary-300 hover:shadow-md transition-all bg-white relative group">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                                </div>
                                <h4 class="font-semibold text-slate-800 text-sm truncate mb-1" title="{{ $backup['name'] }}">{{ $backup['name'] }}</h4>
                                <div class="flex items-center gap-3 text-xs text-slate-500 mb-4">
                                    <span>{{ $backup['size'] }}</span>
                                    <span>&bull;</span>
                                    <span>{{ $backup['date'] }}</span>
                                </div>
                                
                                <div class="flex flex-col gap-2">
                                    <div class="flex gap-2">
                                        <form action="{{ route('backup.restore', $backup['name']) }}" method="POST" class="flex-1 m-0 p-0" onsubmit="return confirm('PERINGATAN: Aksi ini akan menimpa (replace) seluruh data database saat ini dengan data dari file backup tersebut. Apakah Anda benar-benar yakin ingin melakukan restore?')">
                                            @csrf
                                            <button type="submit" class="w-full btn-secondary !py-1.5 text-center text-xs flex justify-center items-center gap-1 hover:bg-amber-50 hover:text-amber-700 hover:border-amber-200 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                Restore
                                            </button>
                                        </form>
                                        <a href="{{ route('backup.download', $backup['name']) }}" class="flex-1 btn-secondary !py-1.5 text-center text-xs flex justify-center items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            Unduh
                                        </a>
                                    </div>
                                    <form action="{{ route('backup.destroy', $backup['name']) }}" method="POST" class="w-full m-0 p-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file backup ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full btn-secondary !py-1.5 text-center text-xs flex justify-center items-center gap-1 hover:bg-red-50 hover:text-red-700 hover:border-red-200 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                        <h4 class="text-lg font-medium text-slate-900 mb-1">Belum Ada Backup</h4>
                        <p class="text-slate-500 text-sm">Sistem belum pernah melakukan pencadangan database.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
