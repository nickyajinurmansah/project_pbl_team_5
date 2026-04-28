@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4 text-green-800">Tambah Pengurus</h1>

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="nama" value="{{ old('nama') }}"
            placeholder="Nama"
            class="border p-2 w-full mb-3 rounded">

        <select name="jenisKelamin" class="border p-2 w-full mb-4 rounded">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Pria" {{ old('status') == 'Pria' ? 'selected' : '' }}>Pria</option>
            <option value="Perempuan" {{ old('status') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>

        <input type="text" name="jabatan" value="{{ old('jabatan') }}"
            placeholder="Jabatan"
            class="border p-2 w-full mb-3 rounded">

        <input type="text" name="no_hp" value="{{ old('no_hp') }}"
            placeholder="No HP"
            class="border p-2 w-full mb-3 rounded">

        <input type="email" name="email" value="{{ old('email') }}"
            placeholder="Email"
            class="border p-2 w-full mb-3 rounded">
        
        <input type="alamat" name="alamat" value="{{ old('alamat') }}"
            placeholder="Alamat"
            class="border p-2 w-full mb-3 rounded">

        <label class="block mb-1 text-sm">Upload Foto</label>
        <input type="file" name="foto" class="mb-3">

        <textarea name="bio"
            placeholder="Bio"
            class="border p-2 w-full mb-3 rounded">{{ old('bio') }}</textarea>

        <select name="status" class="border p-2 w-full mb-4 rounded">
            <option value="">-- Pilih Status --</option>
            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="non-Aktif" {{ old('status') == 'non-Aktif' ? 'selected' : '' }}>Non Aktif</option>
        </select>

        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full">
            Simpan
        </button>

    </form>
</div>

@endsection