<x-app-layout>
    @section('title', 'Monitoring RFID')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Absensi</span>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Monitoring RFID</span>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg flex items-center gap-3 shadow-sm border border-green-100">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg flex items-center gap-3 shadow-sm border border-red-100">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Alpine Data for Modal -->
    <div x-data="{ 
        showModal: false, 
        mode: 'register', 
        rfidId: null, 
        uidDisplay: '', 
        openAssignModal(id, uid) {
            this.mode = 'assign';
            this.rfidId = id;
            this.uidDisplay = uid;
            this.showModal = true;
        },
        openRegisterModal() {
            this.mode = 'register';
            this.rfidId = null;
            this.uidDisplay = '';
            this.showModal = true;
            setTimeout(() => document.getElementById('uid_input').focus(), 100);
        }
    }">

        <!-- Top Bar: Search & Action -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <form method="GET" action="{{ route('rfid.index') }}" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-input pl-10 h-10 w-full sm:w-72" placeholder="Cari UID atau Nama Peserta...">
                </div>
                
                <select name="status" class="form-input h-10 w-full sm:w-48 text-slate-600">
                    <option value="">Semua Status</option>
                    <option value="ACTIVE" {{ request('status') == 'ACTIVE' ? 'selected' : '' }}>Tersambung (ACTIVE)</option>
                    <option value="UNASSIGNED" {{ request('status') == 'UNASSIGNED' ? 'selected' : '' }}>Belum Dimiliki (UNASSIGNED)</option>
                    <option value="BLOCKED" {{ request('status') == 'BLOCKED' ? 'selected' : '' }}>Diblokir (BLOCKED)</option>
                </select>

                <button type="submit" class="btn-secondary h-10 px-4">Filter</button>
                
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('rfid.index') }}" class="btn-secondary h-10 px-4 flex items-center text-red-600 border-red-200 hover:bg-red-50">Reset</a>
                @endif
            </form>

            <button @click="openRegisterModal()" class="btn-primary h-10 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah RFID Manual
            </button>
        </div>

        <!-- Table Card -->
        <div class="card">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-semibold text-slate-500 tracking-wider">
                            <th class="px-6 py-4">UID Kartu</th>
                            <th class="px-6 py-4">Peserta Terhubung</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Pendaftaran</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-sm">
                        @forelse ($rfidCards as $rfid)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-mono text-slate-900 font-semibold tracking-wider bg-slate-100 px-2 py-1 rounded inline-block">{{ $rfid->uid }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($rfid->participant)
                                        <div class="flex items-center gap-3">
                                            @if($rfid->participant->photo_url)
                                                <img src="{{ $rfid->participant->photo_url }}" class="w-8 h-8 rounded-full object-cover border border-slate-200">
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold border border-primary-200 text-xs">
                                                    {{ substr($rfid->participant->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <a href="{{ route('participants.show', $rfid->participant_id) }}" class="font-medium text-primary-700 hover:underline">{{ $rfid->participant->name }}</a>
                                                <div class="text-slate-500 text-xs">{{ $rfid->participant->participant_code }}</div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-slate-400 italic">Belum ada pemilik</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($rfid->status->value == 'ACTIVE')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Active
                                        </span>
                                    @elseif($rfid->status->value == 'UNASSIGNED')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Unassigned
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Blocked
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-slate-900">{{ $rfid->registered_at ? $rfid->registered_at->format('d/m/Y H:i') : '-' }}</div>
                                    <div class="text-slate-500 text-xs">Di station: {{ $rfid->lastStation?->name ?? 'Sistem/Web' }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($rfid->status->value == 'UNASSIGNED')
                                            <!-- Tombol Assign untuk kartu nganggur -->
                                            <button @click="openAssignModal({{ $rfid->id }}, '{{ $rfid->uid }}')" class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg transition-colors border border-primary-100 flex items-center gap-1 text-xs font-medium" title="Hubungkan ke Peserta">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                                Assign
                                            </button>
                                        @endif
                                        
                                        @if($rfid->status->value == 'ACTIVE')
                                            <!-- Tombol Cabut -->
                                            <form action="{{ route('rfid.destroy', $rfid->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin mencabut kartu ini dari peserta? Kartu akan menjadi UNASSIGNED dan bisa dipakai peserta lain.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-red-100 flex items-center gap-1 text-xs font-medium" title="Cabut Akses">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                    Cabut
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                        <p>Belum ada data kartu RFID yang terdaftar.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($rfidCards->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $rfidCards->links() }}
                </div>
            @endif
        </div>

        <!-- Modal (Alpine.js) -->
        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Background backdrop -->
            <div x-show="showModal" 
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-slate-900 bg-opacity-50 transition-opacity"></div>

            <!-- Modal Panel -->
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
                <div x-show="showModal" @click.away="showModal = false"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg w-full">
                    
                    <!-- Header -->
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-semibold text-slate-900" id="modal-title" x-text="mode === 'register' ? 'Registrasi RFID Baru' : 'Assign RFID ke Peserta'"></h3>
                        <button @click="showModal = false" class="text-slate-400 hover:text-slate-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <!-- Formulir Dinamis -->
                    <form :action="mode === 'register' ? '{{ route('rfid.store') }}' : '{{ url('rfid') }}/' + rfidId" method="POST">
                        @csrf
                        <!-- Alpine if untuk spoofing method PUT saat update -->
                        <template x-if="mode === 'assign'">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="px-6 py-6 space-y-5">
                            
                            <!-- Input UID (Hanya muncul saat Register) -->
                            <div x-show="mode === 'register'">
                                <label class="block text-sm font-medium text-slate-700 mb-1">UID Kartu <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                    </div>
                                    <input type="text" name="uid" id="uid_input" class="form-input pl-10 font-mono tracking-widest uppercase" placeholder="Tap kartu / ketik UID" :required="mode === 'register'">
                                </div>
                                <p class="mt-1 text-xs text-slate-500">Anda dapat menghubungkan alat reader RFID dan me-tap kartu ke sini.</p>
                            </div>

                            <!-- Tampilan UID Readonly (Hanya saat Assign) -->
                            <div x-show="mode === 'assign'">
                                <label class="block text-sm font-medium text-slate-700 mb-1">UID Kartu Terpilih</label>
                                <div class="w-full bg-slate-100 px-4 py-2 rounded-lg font-mono tracking-widest text-lg font-semibold text-slate-700 text-center border border-slate-200" x-text="uidDisplay"></div>
                            </div>

                            <!-- Pemilihan Peserta (Muncul di dua mode) -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Peserta <span class="text-red-500">*</span></label>
                                <select name="participant_id" class="form-input" required>
                                    <option value="">-- Pilih Peserta (Yang belum memiliki RFID) --</option>
                                    @foreach($availableParticipants as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->participant_code }}) - {{ $p->mwcnu?->name ?? $p->organization ?? 'Tanpa Utusan' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="showModal = false" class="btn-secondary">Batal</button>
                            <button type="submit" class="btn-primary flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                <span x-text="mode === 'register' ? 'Daftarkan RFID' : 'Hubungkan RFID'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
