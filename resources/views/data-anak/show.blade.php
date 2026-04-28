@extends('layouts.app')
@section('header', 'Detail Data Anak Panti')
<!-- @php
    $header = 'Detail Anak';
@endphp -->

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('data-anak.index') }}" 
           class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white font-semibold px-5 py-2.5 rounded-xl transition shadow-md">
            <span class="text-lg">⬅️</span> 
            <span>Kembali ke Data Anak</span>
        </a>
    </div>

    <!-- Header dengan Tombol -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Informasi Detail Anak</h2>
            <p class="text-gray-600 text-sm">Detail lengkap data anak panti asuhan</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('data-anak.edit', $data_anak) }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold text-sm flex items-center gap-1">
                <span>✏️</span> Edit
            </a>
            <form action="{{ route('data-anak.destroy', $data_anak) }}" method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold text-sm flex items-center gap-1">
                    <span>🗑️</span> Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Card Utama -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        
        <!-- Profil Singkat - Header -->
        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-200">
            <!-- Foto Profil Kecil -->
            <div class="flex-shrink-0">
                @if($data_anak->Foto)
                    <img src="{{ asset('storage/' . $data_anak->Foto) }}" 
                         alt="{{ $data_anak->nama }}" 
                         class="w-20 h-20 rounded-full object-cover border-2 border-green-300">
                @else
                    <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center border-2 border-green-300">
                        <span class="text-3xl text-gray-500">👤</span>
                    </div>
                @endif
            </div>

            <!-- Nama dan Badge -->
            <div class="flex-1">
                <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $data_anak->nama }}</h3>
                <p class="text-sm text-gray-600 mb-2">NIK: {{ $data_anak->NIK }}</p>
                <div class="flex gap-2">
                    <span class="px-3 py-1 rounded-full text-xs font-bold 
                        {{ $data_anak->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $data_anak->status }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold 
                        {{ $data_anak->kategori_anak == 'Internal' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                        {{ $data_anak->kategori_anak }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Informasi Detail - Grid 2 Kolom -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-50 p-3 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Tanggal Lahir</p>
                <p class="text-sm font-bold text-gray-800">{{ $data_anak->tgl_lahir->format('d M Y') }}</p>
            </div>

            <div class="bg-gray-50 p-3 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Jenis Kelamin</p>
                <p class="text-sm font-bold text-gray-800">
                    {{ $data_anak->jns_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                </p>
            </div>

            <div class="bg-gray-50 p-3 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Tanggal Masuk</p>
                <p class="text-sm font-bold text-gray-800">{{ $data_anak->tgl_masuk->format('d M Y') }}</p>
            </div>

            <div class="bg-gray-50 p-3 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Nama Orang Tua</p>
                <p class="text-sm font-bold text-gray-800">{{ $data_anak->nama_Ortu ?? '-' }}</p>
            </div>

            <div class="bg-gray-50 p-3 rounded-lg md:col-span-2">
                <p class="text-xs text-gray-600 mb-1">Alamat</p>
                <p class="text-sm font-bold text-gray-800">{{ $data_anak->alamat ?? '-' }}</p>
            </div>
        </div>

        <!-- ✅ INFO SISTEM - TARUH DI SINI (Paling Bawah Card) -->
        <div class="mt-6 pt-4 border-t border-gray-200 text-xs text-gray-500">
            <div class="grid grid-cols-2 gap-4">
                <div>Dibuat: {{ $data_anak->created_at ? $data_anak->created_at->format('d M Y, H:i') : '-' }}</div>
                <div>Update: {{ $data_anak->updated_at ? $data_anak->updated_at->format('d M Y, H:i') : '-' }}</div>
            </div>
        </div>

    </div> <!-- Penutup Card Utama -->
</div>
@endsection