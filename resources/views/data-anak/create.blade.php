@extends('layouts.app')

@php
    $header = 'Registrasi Anak';
@endphp

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    
    <!-- Form -->
    <form action="{{ route('data-anak.store') }}" method="POST" enctype="multipart/form-data" 
        class="bg-white rounded-xl shadow-lg overflow-hidden">
        @csrf
        
        <div class="p-6 md:p-8">
            
            <!-- Section: Data Pribadi Anak -->
            <h6 class="text-lg font-semibold text-panti-primary mb-4 flex items-center gap-2">
                <span>👤</span> Data Pribadi Anak
            </h6>
            <hr class="border-gray-200 mb-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIK -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="NIK" value="{{ old('NIK') }}" maxlength="16"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('NIK') border-red-500 @enderror"
                        required placeholder="16 digit angka">
                    @error('NIK') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Nama Lengkap -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('nama_lengkap') border-red-500 @enderror"
                        required placeholder="Nama lengkap anak">
                    @error('nama_lengkap') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('tanggal_lahir') border-red-500 @enderror"
                        required>
                    @error('tanggal_lahir') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('jenis_kelamin') border-red-500 @enderror"
                        required>
                        <option value="">Pilih...</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal Masuk -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal Masuk <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('tanggal_masuk') border-red-500 @enderror"
                        required>
                    @error('tanggal_masuk') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kategori Anak -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Kategori Anak <span class="text-red-500">*</span></label>
                    <select name="kategori_anak" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('kategori_anak') border-red-500 @enderror"
                        required>
                        <option value="">Pilih...</option>
                        <option value="Internal" {{ old('kategori_anak') == 'Internal' ? 'selected' : '' }}>Internal</option>
                        <option value="External" {{ old('kategori_anak') == 'External' ? 'selected' : '' }}>External</option>
                    </select>
                    @error('kategori_anak') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('status') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Status...</option>
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat Anak -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Alamat Anak</label>
                    <textarea name="alamat" rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('alamat') border-red-500 @enderror"
                        placeholder="Alamat lengkap anak">{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Section: Data Orang Tua -->
            <h6 class="text-lg font-semibold text-panti-primary mb-4 mt-8 flex items-center gap-2">
                <span>👨‍👩‍</span> Data Orang Tua
            </h6>
            <hr class="border-gray-200 mb-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Ayah -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nama Ayah</label>
                    <input type="text" name="nama_ayah" 
                        value="{{ old('nama_ayah') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('nama_ayah') border-red-500 @enderror"
                        placeholder="Nama lengkap ayah">
                    @error('nama_ayah') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Nama Ibu -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_ibu" 
                        value="{{ old('nama_ibu') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('nama_ibu') border-red-500 @enderror"
                        placeholder="Nama lengkap ibu" required>
                    @error('nama_ibu') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat Orang Tua -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Alamat Orang Tua</label>
                    <textarea name="alamat_orang_tua" rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('alamat_orang_tua') border-red-500 @enderror"
                        placeholder="Alamat lengkap orang tua">{{ old('alamat_orang_tua') }}</textarea>
                    @error('alamat_orang_tua') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Section: Foto -->
            <h6 class="text-lg font-semibold text-panti-primary mb-4 mt-8 flex items-center gap-2">
                <span>📷</span> Foto Anak
            </h6>
            <hr class="border-gray-200 mb-6">
            
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-semibold mb-2">Foto Anak</label>
                <input type="file" 
                       name="foto_anak" 
                       id="foto_anak"
                       accept="image/*"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary @error('foto_anak') border-red-500 @enderror"
                       onchange="previewImage(this)">
                <p class="text-sm text-gray-500 mt-1">Upload foto anak (JPG, PNG, GIF - Max 5MB)</p>
                @error('foto_anak') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 mb-2">Preview:</p>
                    <img id="preview" src="" alt="Preview" class="w-24 h-24 object-cover rounded-lg border-2 border-gray-200">
                </div>
            </div>

        </div>

        <!-- Tombol Aksi -->
        <div class="px-6 py-4 md:px-8 md:py-6 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
            <a href="{{ route('data-anak.index') }}" 
                class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-100 transition flex items-center gap-2">
                <span>✕</span> Batal
            </a>
            <button type="submit" 
                class="px-8 py-3 rounded-xl bg-green-700 text-white font-bold hover:bg-green-800 transition shadow-lg flex items-center gap-2">
                <span>💾</span> Simpan Data
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
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endsection