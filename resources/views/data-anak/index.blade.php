@extends('layouts.app')

@php
    $header = 'Data Anak';  // ← JUDUL DI HEADER ATAS
@endphp

@section('content')
<!-- <div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <span class="mr-2">📂</span> Data Anak
    </h1>
    <p class="text-gray-600 mt-1">Kelola data anak panti asuhan</p>
</div> -->

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-panti-primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Anak</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalAnak }}</h3>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <span class="text-2xl">👶</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Internal</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $internal }}</h3>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <span class="text-2xl">🏠</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">External</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $external }}</h3>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <span class="text-2xl">🌍</span>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6 bg-panti-header border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative flex-1 md:w-64">
                <input type="text" id="search" placeholder="Cari anak..." 
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary">
                <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
            </div>
        </div>
        <a href="{{ route('data-anak.create') }}" 
            class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2 transition shadow-md w-full md:w-auto justify-center">
            <span>➕</span> Tambah Data Anak
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Foto</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">NIK</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tgl Lahir</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Jenis Kelamin</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($data_anak as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration + $data_anak->firstItem() - 1 }}</td>
                    <td class="px-6 py-4">
                        @if($item->Foto)
                            <img src="{{ asset('storage/' . $item->Foto) }}" alt="{{ $item->nama }}" 
                                class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                        @else
                            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-600">👤</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-mono text-gray-700">{{ $item->NIK }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->tgl_lahir->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                            {{ $item->jns_kelamin == 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                            {{ $item->jns_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                            {{ $item->kategori_anak == 'Internal' ? 'bg-green-100 text-green-700' : 'bg-purple-100 text-purple-700' }}">
                            {{ $item->kategori_anak }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                            {{ $item->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('data-anak.show', $item) }}" 
                                class="text-blue-600 hover:text-blue-800 p-1 rounded hover:bg-blue-50 transition" title="Lihat">
                                👁️
                            </a>
                            <a href="{{ route('data-anak.edit', $item) }}" 
                                class="text-yellow-600 hover:text-yellow-800 p-1 rounded hover:bg-yellow-50 transition" title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('data-anak.destroy', $item) }}" method="POST" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="text-red-600 hover:text-red-800 p-1 rounded hover:bg-red-50 transition" title="Hapus">
                                🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <span class="text-4xl mb-2">📭</span>
                            <p>Belum ada data anak</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($data_anak->hasPages())
    <div class="p-4 border-t border-gray-200 bg-gray-50">
        {{ $data_anak->links() }}
    </div>
    @endif
</div>
@endsection