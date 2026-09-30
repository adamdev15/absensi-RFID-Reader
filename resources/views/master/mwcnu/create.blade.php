<x-app-layout>
    @section('title', 'Tambah MWCNU')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('mwcnu.index') }}" class="hover:text-primary-700">MWCNU</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Tambah</span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <div class="px-6 py-4 border-b border-slate-200">
                <h3 class="font-semibold text-slate-800">Form Tambah MWCNU</h3>
            </div>
            
            <form action="{{ route('mwcnu.store') }}" method="POST" class="p-6">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama MWCNU <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input" required placeholder="Contoh: MWCNU Slawi, MWCNU Lebaksiu">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" class="form-input" required>
                            <option value="ACTIVE" {{ old('status') == 'ACTIVE' ? 'selected' : '' }}>Aktif</option>
                            <option value="INACTIVE" {{ old('status') == 'INACTIVE' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('mwcnu.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">Simpan MWCNU</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
