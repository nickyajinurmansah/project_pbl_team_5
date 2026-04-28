@extends('layouts.app')
@section('header', 'Data Anak Panti')
<!-- @php
    $header = 'Data Anak';  // ← JUDUL DI HEADER ATAS
@endphp -->

@section('content')
<!-- <div class="bg-white p-6 rounded shadow">
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
            
            <!-- FORM PENCARIAN -->
            <form action="{{ route('data-anak.index') }}" method="GET" class="w-full md:w-auto flex-1 md:flex-initial">
                <div class="relative">
                    <input type="text" name="search" id="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari NIK, Nama Lengkap..." 
                        class="w-full md:w-80 pl-10 pr-10 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-panti-primary">
                    <span class="absolute left-3 top-3 text-gray-400">🔍</span>
                    @if(request('search'))
                        <a href="{{ route('data-anak.index') }}" 
                           class="absolute right-3 top-3 text-gray-400 hover:text-gray-600" title="Reset">
                            ✕
                        </a>
                    @endif
                </div>
            </form>
            
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
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama Lengkap</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Orang Tua</th>
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
                        
                        <!-- ✅ PERBAIKAN: Foto -->
                        <td class="px-6 py-4">
                            @if($item->foto_anak)
                                <img src="{{ asset('storage/' . $item->foto_anak) }}" alt="{{ $item->nama_lengkap }}" 
                                    class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-gray-600">👤</span>
                                </div>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 text-sm font-mono text-gray-700">{{ $item->NIK }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->nama_lengkap }}</td>
                        
                        <!-- Orang Tua -->
                        <td class="px-6 py-4 text-sm text-gray-600">
                            @if($item->nama_ayah && $item->nama_ibu)
                                <div>👨 {{ $item->nama_ayah }}</div>
                                <div>👩 {{ $item->nama_ibu }}</div>
                            @elseif($item->nama_ayah)
                                👨 {{ $item->nama_ayah }}
                            @elseif($item->nama_ibu)
                                👩 {{ $item->nama_ibu }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        
                        <!-- ✅ PERBAIKAN: tanggal_lahir -->
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->tanggal_lahir?->format('d M Y') }}</td>
                        
                        <!-- ✅ PERBAIKAN: jenis_kelamin -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium 
                                {{ $item->jenis_kelamin == 'Laki-laki' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                {{ $item->jenis_kelamin }}
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
                                {{ $item->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('data-anak.show', $item) }}" 
                                    class="text-blue-600 hover:text-blue-800 p-2 rounded hover:bg-blue-50 transition" title="Lihat">
                                    👁️
                                </a>
                                <a href="{{ route('data-anak.edit', $item) }}" 
                                    class="text-yellow-600 hover:text-yellow-800 p-2 rounded hover:bg-yellow-50 transition" title="Edit">
                                    ✏️
                                </a>
                                <form action="{{ route('data-anak.destroy', $item) }}" method="POST" 
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="text-red-600 hover:text-red-800 p-2 rounded hover:bg-red-50 transition" title="Hapus">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <span class="text-5xl mb-3">📭</span>
                                <p class="text-lg font-medium">Belum ada data anak</p>
                                <p class="text-sm text-gray-400 mt-1">Mulai dengan menambah data baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($data_anak->hasPages())
        <div class="p-4 border-t border-gray-200 bg-gray-50">
            {{ $data_anak->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection