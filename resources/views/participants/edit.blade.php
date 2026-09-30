<x-app-layout>
    @section('title', 'Edit Peserta')

    <x-slot name="header">
        <div class="flex items-center text-sm text-slate-500">
            <a href="{{ route('dashboard') }}" class="hover:text-primary-700">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('participants.index') }}" class="hover:text-primary-700">Data Peserta</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-primary-700 font-medium">Edit: {{ $participant->name }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="card">
            <div class="px-6 py-4 border-b border-slate-200">
                <h3 class="font-semibold text-slate-800">Form Edit Peserta</h3>
            </div>
            
            <form action="{{ route('participants.update', $participant->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode Peserta (Auto) -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kode Peserta <span class="text-red-500">*</span></label>
                        <input type="text" name="participant_code" value="{{ old('participant_code', $participant->participant_code) }}" class="form-input bg-slate-50" readonly required>
                        @error('participant_code') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" class="form-input" required>
                            <option value="ACTIVE" {{ old('status', $participant->status->value) == 'ACTIVE' ? 'selected' : '' }}>Aktif</option>
                            <option value="INACTIVE" {{ old('status', $participant->status->value) == 'INACTIVE' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $participant->name) }}" class="form-input" required>
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="birth_place" value="{{ old('birth_place', $participant->birth_place) }}" class="form-input">
                        @error('birth_place') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $participant->birth_date?->format('Y-m-d')) }}" class="form-input">
                        @error('birth_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin</label>
                        <select name="gender" class="form-input">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('gender', $participant->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender', $participant->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Utusan -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Utusan</label>
                        <select name="utusan_id" class="form-input">
                            <option value="">-- Pilih Utusan --</option>
                            @foreach($utusanList as $u)
                                <option value="{{ $u->id }}" {{ old('utusan_id', $participant->utusan_id) == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                        @error('utusan_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan</label>
                        <select name="jabatan_id" class="form-input">
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($positions as $p)
                                <option value="{{ $p->id }}" {{ old('jabatan_id', $participant->jabatan_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                            @endforeach
                        </select>
                        @error('jabatan_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- MWCNU -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">MWCNU</label>
                        <select name="mwcnu_id" class="form-input">
                            <option value="">-- Pilih MWCNU --</option>
                            @foreach($mwcnuList as $m)
                                <option value="{{ $m->id }}" {{ old('mwcnu_id', $participant->mwcnu_id) == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                            @endforeach
                        </select>
                        @error('mwcnu_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Organisasi Lainnya -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Asal Lembaga / Banom (Opsional)</label>
                        <input type="text" name="organization" value="{{ old('organization', $participant->organization) }}" class="form-input">
                        @error('organization') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2 border-t border-slate-200 mt-2 pt-6">
                        <h4 class="font-medium text-slate-800 mb-4">Dokumen & Lampiran</h4>
                    </div>

                    <!-- Foto -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Foto Peserta (Biarkan kosong jika tidak diubah)</label>
                        @if($participant->photo_url)
                            <div class="mb-3">
                                <img src="{{ $participant->photo_url }}" class="w-20 h-20 rounded-lg object-cover border border-slate-200" alt="Foto">
                            </div>
                        @endif
                        <input type="file" name="photo" accept="image/jpeg,image/png,image/jpg" class="form-input !p-1.5 bg-white">
                        <p class="mt-1 text-xs text-slate-500">Format: JPG, PNG. Maksimal 2MB.</p>
                        @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Surat Mandat -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Surat Mandat (Biarkan kosong jika tidak diubah)</label>
                        @if($participant->mandate_letter_url)
                            <div class="mb-3">
                                <a href="{{ $participant->mandate_letter_url }}" target="_blank" class="text-primary-600 hover:underline text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    Lihat Surat Mandat Saat Ini
                                </a>
                            </div>
                        @endif
                        <input type="file" name="mandate_letter" accept="image/jpeg,image/png,image/jpg,application/pdf" class="form-input !p-1.5 bg-white">
                        <p class="mt-1 text-xs text-slate-500">Format: PDF, JPG, PNG. Maksimal 5MB.</p>
                        @error('mandate_letter') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('participants.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">Update Peserta</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
