@extends('layouts.app')
@section('header', 'Edit data Anak Panti')
<!-- @php
    $header = 'Edit Data Anak';  // ← JUDUL DI HEADER ATAS
@endphp -->

@section('content')
<div class="mb-6">
    <a href="{{ route('data-anak.index') }}" 
       class="inline-flex items-center gap-2 bg-white/60 hover:bg-white text-green-800 font-semibold px-4 py-2.5 rounded-xl transition shadow-sm">
        <span class="text-lg">⬅️</span> Kembali ke Data Anak
    </a>
</div>

    <form action="{{ route('data-anak.update', $data_anak) }}" method="POST" enctype="multipart/form-data" 
        class="bg-white rounded-xl shadow-lg overflow-hidden">
        @csrf
        @method('PUT')
        
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIK -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="NIK" value="{{ old('NIK', $data_anak->NIK) }}" maxlength="16"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('NIK') border-red-500 @enderror"
                        required>
                    @error('NIK') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Nama -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $data_anak->nama) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('nama') border-red-500 @enderror"
                        required>
                    @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $data_anak->tgl_lahir->format('Y-m-d')) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('tgl_lahir') border-red-500 @enderror"
                        required>
                    @error('tgl_lahir') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jns_kelamin" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('jns_kelamin') border-red-500 @enderror"
                        required>
                        <option value="L" {{ old('jns_kelamin', $data_anak->jns_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jns_kelamin', $data_anak->jns_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jns_kelamin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal Masuk -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal Masuk <span class="text-red-500">*</span></label>
                    <input type="date" name="tgl_masuk" value="{{ old('tgl_masuk', $data_anak->tgl_masuk->format('Y-m-d')) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('tgl_masuk') border-red-500 @enderror"
                        required>
                    @error('tgl_masuk') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kategori Anak -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Kategori Anak <span class="text-red-500">*</span></label>
                    <select name="kategori_anak" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('kategori_anak') border-red-500 @enderror"
                        required>
                        <option value="Internal" {{ old('kategori_anak', $data_anak->kategori_anak) == 'Internal' ? 'selected' : '' }}>Internal</option>
                        <option value="External" {{ old('kategori_anak', $data_anak->kategori_anak) == 'External' ? 'selected' : '' }}>External</option>
                    </select>
                    @error('kategori_anak') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('status') border-red-500 @enderror"
                        required>
                        <option value="Aktif" {{ old('status', $data_anak->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Alumni" {{ old('status', $data_anak->status) == 'Alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="Pindah" {{ old('status', $data_anak->status) == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Nama Ortu -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nama Orang Tua</label>
                    <input type="text" name="nama_Ortu" value="{{ old('nama_Ortu', $data_anak->nama_Ortu) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('nama_Ortu') border-red-500 @enderror">
                    @error('nama_Ortu') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
                    <textarea name="alamat" rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('alamat') border-red-500 @enderror">{{ old('alamat', $data_anak->alamat) }}</textarea>
                    @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Foto -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Foto Anak</label>
                    @if($data_anak->Foto)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $data_anak->Foto) }}" alt="Foto saat ini" 
                                class="w-32 h-32 object-cover rounded-lg border-2 border-gray-300">
                            <p class="text-sm text-gray-500 mt-1">Foto saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="Foto" accept="image/*"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('Foto') border-red-500 @enderror"
                        onchange="previewImage(this)">
                    <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti foto</p>
                    @error('Foto') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    <div id="imagePreview" class="mt-3 hidden">
                        <img id="preview" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-300">
                    </div>
                </div>
            </div>
        </div>

        <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-end gap-4">
            <a href="{{ route('data-anak.index') }}" 
                class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-100 transition">
                Batal
            </a>
            <button type="submit" 
                class="px-8 py-3 rounded-xl bg-green-700 text-white font-bold hover:bg-green-800 transition shadow-lg">
                 Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const img = document.getElementById('preview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection