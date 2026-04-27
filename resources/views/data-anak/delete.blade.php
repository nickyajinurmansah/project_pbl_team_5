@extends('layouts.app')

@section('content')
@php
    $header = 'Hapus Data Anak';
@endphp

<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('data-anak.index') }}" class="text-green-800 hover:text-green-900 flex items-center gap-2 mb-4 font-semibold">
            <span>←</span> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header Warning -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 p-8 text-center">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <span class="text-4xl">⚠️</span>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2">Konfirmasi Hapus</h2>
            <p class="text-red-100">Apakah Anda yakin ingin menghapus data ini?</p>
        </div>

        <!-- Data Preview -->
        <div class="p-8">
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">🚨</span>
                    <div>
                        <h3 class="text-red-800 font-bold mb-1">Peringatan!</h3>
                        <p class="text-red-700">Tindakan ini tidak dapat dibatalkan. Data yang dihapus akan hilang secara permanen dari sistem.</p>
                    </div>
                </div>
            </div>

            <!-- Data yang akan dihapus -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 mb-6">
                <h3 class="text-lg font-bold text-green-900 mb-4 flex items-center">
                    <span class="mr-2">📋</span> Data yang akan dihapus:
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center gap-4">
                        @if($data_anak->Foto)
                            <img src="{{ asset('storage/' . $data_anak->Foto) }}" alt="{{ $data_anak->nama }}" 
                                class="w-16 h-16 rounded-full object-cover border-2 border-gray-300">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-2xl">👤</span>
                            </div>
                        @endif
                        <div>
                            <p class="text-sm text-gray-600">Nama</p>
                            <p class="text-lg font-bold text-green-900">{{ $data_anak->nama }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">NIK</p>
                        <p class="text-lg font-bold text-gray-800 font-mono">{{ $data_anak->NIK }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Tanggal Lahir</p>
                        <p class="text-gray-800 font-semibold">{{ $data_anak->tgl_lahir->format('d F Y') }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Jenis Kelamin</p>
                        <p class="text-gray-800 font-semibold">
                            {{ $data_anak->jns_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Tanggal Masuk</p>
                        <p class="text-gray-800 font-semibold">{{ $data_anak->tgl_masuk->format('d F Y') }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold 
                            {{ $data_anak->status == 'Aktif' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                            {{ $data_anak->status }}
                        </span>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-600">Alamat</p>
                        <p class="text-gray-800">{{ $data_anak->alamat ?? '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-600">Nama Orang Tua</p>
                        <p class="text-gray-800 font-semibold">{{ $data_anak->nama_Ortu ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Checkbox Confirmation -->
            <div class="mb-6">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" id="confirmDelete" 
                        class="w-5 h-5 mt-0.5 rounded border-gray-300 text-red-600 focus:ring-red-500">
                    <div>
                        <span class="text-gray-700 font-semibold">Saya memahami bahwa data ini akan dihapus secara permanen</span>
                        <p class="text-sm text-gray-500 mt-1">Tindakan ini tidak dapat dibatalkan dan semua data terkait akan hilang.</p>
                    </div>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 justify-end">
                <a href="{{ route('data-anak.index') }}" 
                    class="px-8 py-3 rounded-xl border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-100 transition">
                    Batal
                </a>
                <form action="{{ route('data-anak.destroy', $data_anak) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="btnDelete" disabled
                        class="px-8 py-3 rounded-xl bg-red-500 text-white font-bold hover:bg-red-600 transition shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                        <span>🗑️</span> Ya, Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Enable delete button when checkbox is checked
document.getElementById('confirmDelete').addEventListener('change', function() {
    document.getElementById('btnDelete').disabled = !this.checked;
});
</script>
@endsection