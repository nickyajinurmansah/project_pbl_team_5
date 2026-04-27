@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Data Donatur</h1>
    </div>

    <div class="max-w-3xl bg-white p-8 rounded-2xl shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">Perbarui Data: {{ $donatur->nama_donatur }}</h2>
            <a href="{{ route('donatur.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Kembali</a>
        </div>

        <form action="{{ route('donatur.update', $donatur->id_donatur) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_donatur" value="{{ $donatur->nama_donatur }}" required 
                    class="w-full bg-[#F4F9F1] border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#4D7653] outline-none transition">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $donatur->email }}" required 
                        class="w-full bg-[#F4F9F1] border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#4D7653] outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                    <input type="text" name="no_hp" value="{{ $donatur->no_hp }}" required 
                        class="w-full bg-[#F4F9F1] border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#4D7653] outline-none transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Domisili</label>
                <textarea name="alamat" rows="3" required 
                    class="w-full bg-[#F4F9F1] border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#4D7653] outline-none transition">{{ $donatur->alamat }}</textarea>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100 mt-6">
                <button type="submit" class="bg-[#4D7653] text-white px-8 py-3 rounded-full font-semibold shadow-sm hover:bg-[#3b5c40] transition">
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
@endsection