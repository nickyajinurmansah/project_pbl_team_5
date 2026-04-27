@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-full">
    
    <div class="md:col-span-8 flex flex-col gap-6">
        
        <div class="flex gap-4">
            <div class="bg-[#4D7653] text-white p-5 rounded-lg w-32 md:w-40 shadow-sm flex flex-col justify-center">
                <h3 class="text-4xl font-bold text-center mb-1">{{ $totalDonatur ?? 0 }}</h3>
                <p class="text-xs text-center opacity-90">Total donatur</p>
            </div>
            <div class="bg-[#4D7653] text-white p-5 rounded-lg w-32 md:w-40 shadow-sm flex flex-col justify-center">
                <h3 class="text-4xl font-bold text-center mb-1">{{ $donaturTetap ?? 0 }}</h3>
                <p class="text-xs text-center opacity-90">Donatur tetap</p>
            </div>
        </div>

        <div>
            <a href="{{ route('donatur.create') }}" class="inline-flex bg-white border border-gray-200 text-gray-700 px-5 py-2 rounded-full shadow-sm text-sm font-semibold items-center gap-2 hover:bg-gray-50 transition">
                Tambah Data <span class="text-lg font-bold leading-none mb-0.5">+</span>
            </a>
        </div>

        <div class="bg-[#4D7653] rounded-xl p-5 shadow-sm mt-2 flex-1">
            <h4 class="text-white text-sm font-medium mb-4">Data Donatur Tetap</h4>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                @foreach($donaturs as $donatur)
                <div class="bg-white rounded-lg p-3 flex justify-between items-start shadow-sm h-auto min-h-[5rem]">
                    <div class="flex items-center gap-3">
                        <img src="{{ $donatur->foto ? asset('storage/'.$donatur->foto) : 'https://ui-avatars.com/api/?name='.urlencode($donatur->nama_donatur).'&background=random' }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-800">{{ $donatur->nama_donatur }}</span>
                            <span class="text-xs text-gray-500">{{ $donatur->email }}</span>
                        </div>
                    </div>
                    
                    <div class="flex gap-1 items-center">
                        <a href="{{ route('donatur.edit', $donatur->id_donatur) }}" class="text-blue-500 hover:text-blue-700 p-1.5 bg-blue-50 rounded-md transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>

                        <form action="{{ route('donatur.destroy', $donatur->id_donatur) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data donatur ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 p-1.5 bg-red-50 rounded-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach

            </div>
            
            <div class="flex justify-end mt-4">
                <a href="#" class="text-white/90 text-xs hover:text-white flex items-center gap-1">
                    Lainnya... <span class="text-lg leading-none mb-0.5">↗</span>
                </a>
            </div>
        </div>

    </div>

    <div class="md:col-span-4">
        <div class="bg-[#4D7653] rounded-xl p-5 shadow-sm h-full relative min-h-[400px]">
            <div class="flex justify-between items-center text-white mb-8">
                <h3 class="text-sm font-medium">Informasi Donatur</h3>
                <button class="text-white/80 hover:text-white transition cursor-pointer p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="flex justify-center mt-4">
                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-transparent shadow-lg bg-white/10 flex items-center justify-center text-white">
                    <svg class="w-16 h-16 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
            </div>

            <div class="mt-8 text-center text-white">
                <h2 class="text-xl font-bold mb-1">Pilih Donatur</h2>
                <p class="text-sm text-white/70 mb-4">Pilih data di sebelah kiri untuk melihat detail</p>
            </div>
        </div>
    </div>

</div>
@endsection