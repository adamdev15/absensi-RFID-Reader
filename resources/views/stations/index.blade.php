<x-app-layout>
    @section('title', 'Monitoring Station')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Absensi</span>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Monitoring Station</span>
        </div>
    </x-slot>

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

    <div x-data="{ 
        showModal: false, 
        mode: 'create', 
        stationId: null, 
        form: { name: '', type: 'IN', status: 'ACTIVE', mac_address: '', location: '' },
        
        openCreateModal() {
            this.mode = 'create';
            this.stationId = null;
            this.form = { name: '', type: 'IN', status: 'ACTIVE', mac_address: '', location: '' };
            this.showModal = true;
        },
        openEditModal(station) {
            this.mode = 'edit';
            this.stationId = station.id;
            this.form = { 
                name: station.name, 
                type: station.type, 
                status: station.status, 
                mac_address: station.mac_address || '', 
                location: station.location || '' 
            };
            this.showModal = true;
        },
        copyToken(token) {
            navigator.clipboard.writeText(token);
            alert('Token disalin ke clipboard!');
        }
    }">

        <!-- Top Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <form method="GET" action="{{ route('stations.index') }}" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-input pl-10 h-10 w-full sm:w-64" placeholder="Cari nama / MAC...">
                </div>
                
                <select name="type" class="form-input h-10">
                    <option value="">Semua Tipe</option>
                    <option value="IN" {{ request('type') == 'IN' ? 'selected' : '' }}>Masuk</option>
                    <option value="OUT" {{ request('type') == 'OUT' ? 'selected' : '' }}>Keluar</option>
                    <option value="BOTH" {{ request('type') == 'BOTH' ? 'selected' : '' }}>Keduanya</option>
                </select>

                <button type="submit" class="btn-secondary h-10 px-4">Filter</button>
                @if(request()->hasAny(['search', 'type', 'status']))
                    <a href="{{ route('stations.index') }}" class="btn-secondary h-10 px-4 text-red-600 border-red-200 flex items-center">Reset</a>
                @endif
            </form>

            <button @click="openCreateModal()" class="btn-primary h-10 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Registrasi Station
            </button>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($stations as $station)
                <div class="card relative overflow-visible">
                    <!-- Status Indicator -->
                    <div class="absolute top-4 right-4">
                        @if($station->operational_status == 'ONLINE')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                ONLINE
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                OFFLINE
                            </span>
                        @endif
                    </div>

                    <div class="p-6">
                        <h3 class="text-lg font-bold text-slate-800 pr-20">{{ $station->name }}</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                Tipe: {{ $station->type->label() }}
                            </span>
                            <span class="px-2 py-0.5 rounded text-xs font-medium {{ $station->status->value == 'ACTIVE' ? 'bg-primary-50 text-primary-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $station->status->label() }}
                            </span>
                        </div>

                        <div class="mt-4 space-y-2 text-sm text-slate-600">
                            <div class="flex justify-between border-b border-slate-50 pb-2">
                                <span class="text-slate-400">MAC Address</span>
                                <span class="font-mono">{{ $station->mac_address ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-slate-50 pb-2">
                                <span class="text-slate-400">Lokasi</span>
                                <span>{{ $station->location ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-slate-50 pb-2">
                                <span class="text-slate-400">Last Seen</span>
                                <span>{{ $station->last_seen_at ? $station->last_seen_at->diffForHumans() : 'Belum pernah konek' }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-2">
                                <span class="text-slate-400">API Token</span>
                                @if($station->tokens->count() > 0 && $station->tokens->first()->plain_token)
                                    <button @click="copyToken('{{ $station->tokens->first()->plain_token }}')" class="text-primary-600 hover:text-primary-800 text-xs font-medium flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                        Copy Token
                                    </button>
                                @else
                                    <span class="text-xs italic text-slate-400">Token tersembunyi</span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-2 border-t border-slate-100 pt-4">
                            <a href="{{ route('stations.kiosk', $station->id) }}" target="_blank" class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg transition-colors border border-primary-100 flex items-center justify-center mr-auto px-4 text-sm font-medium" title="Buka Station UI">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                Buka Station
                            </a>
                            <button @click="openEditModal({{ $station->toJson() }})" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors border border-amber-100" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>
                            <form action="{{ route('stations.destroy', $station->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus station ini? Token API juga akan terhapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-red-100" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 card p-8 text-center text-slate-500">
                    <div class="flex justify-center mb-4">
                        <div class="p-4 bg-slate-50 rounded-full">
                            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900 mb-1">Belum Ada Station</h3>
                    <p class="text-sm mb-4">Silakan registrasi perangkat kiosk absen/station untuk memulai.</p>
                    <button @click="openCreateModal()" class="btn-primary inline-flex">Registrasi Station Pertama</button>
                </div>
            @endforelse
        </div>

        @if($stations->hasPages())
            <div class="mt-6">
                {{ $stations->links() }}
            </div>
        @endif

        <!-- Modal Form (Create/Edit) -->
        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-slate-900 bg-opacity-50 transition-opacity"></div>

            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
                <div x-show="showModal" @click.away="showModal = false" x-transition class="relative bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg w-full">
                    
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-slate-900" x-text="mode === 'create' ? 'Registrasi Station Baru' : 'Edit Data Station'"></h3>
                        <button @click="showModal = false" class="text-slate-400 hover:text-slate-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form :action="mode === 'create' ? '{{ route('stations.store') }}' : '{{ url('stations') }}/' + stationId" method="POST">
                        @csrf
                        <template x-if="mode === 'edit'">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="px-6 py-6 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Station (Kiosk) <span class="text-red-500">*</span></label>
                                <input type="text" name="name" x-model="form.name" class="form-input" required placeholder="Contoh: KIOSK-MASUK-01">
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Tipe Absensi <span class="text-red-500">*</span></label>
                                    <select name="type" x-model="form.type" class="form-input" required>
                                        <option value="IN">Masuk</option>
                                        <option value="OUT">Keluar</option>
                                        <option value="BOTH">Keduanya</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Kiosk <span class="text-red-500">*</span></label>
                                    <select name="status" x-model="form.status" class="form-input" required>
                                        <option value="ACTIVE">Aktif</option>
                                        <option value="INACTIVE">Nonaktif</option>
                                        <option value="MAINTENANCE">Maintenance</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">MAC Address PC/Alat (Opsional)</label>
                                <input type="text" name="mac_address" x-model="form.mac_address" class="form-input font-mono" placeholder="00:1B:44:11:3A:B7">
                                <p class="mt-1 text-xs text-slate-500">Digunakan untuk validasi keamanan tambahan.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Lokasi (Opsional)</label>
                                <input type="text" name="location" x-model="form.location" class="form-input" placeholder="Contoh: Pintu Utama Gedung A">
                            </div>
                        </div>

                        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="showModal = false" class="btn-secondary">Batal</button>
                            <button type="submit" class="btn-primary" x-text="mode === 'create' ? 'Simpan & Generate Token' : 'Update Station'"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
