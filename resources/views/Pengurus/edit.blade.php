@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Pengurus</h1>

<form action="{{ route('pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="nama" value="{{ $pengurus->nama }}" class="border p-2 w-full mb-2">
    <input type="text" name="jabatan" value="{{ $pengurus->jabatan }}" class="border p-2 w-full mb-2">
    <input type="text" name="no_hp" value="{{ $pengurus->no_hp }}" class="border p-2 w-full mb-2">
    <input type="email" name="email" value="{{ $pengurus->email }}" class="border p-2 w-full mb-2">

    <img src="{{ asset('storage/'.$pengurus->foto) }}" width="100" class="mb-2">

    <input type="file" name="foto" class="mb-2">

    <textarea name="bio" class="border p-2 w-full mb-2">{{ $pengurus->bio }}</textarea>

    <input type="text" name="status" value="{{ $pengurus->status }}" class="border p-2 w-full mb-2">

    <button class="bg-yellow-500 text-white px-4 py-2">Update</button>
</form>

@endsection