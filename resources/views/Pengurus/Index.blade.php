@extends('layouts.app')
@section('header', 'Data Pengurus')
@section('content')

<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Data Pengurus</h1>

    <a href="{{ route('pengurus.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">
        + Tambah Pengurus
    </a>

    <table class="table-auto w-full mt-4 border">
        <thead class="bg-gray-200">
        <tr>
            <th class="p-2">No</th>
            <th class="p-2">ID</th>
            <th class="p-2">Nama</th>
            <th class="p-2">Jenis Kelamin</th>
            <th class="p-2">Jabatan</th>
            <th class="p-2">No HP</th>
            <th class="p-2">Email</th>
            <th class="p-2">Alamat</th>
            <th class="p-2">Foto</th>
            <th class="p-2">Bio</th>
            <th class="p-2">Status</th>
            <th class="p-2">Aksi</th>
        </tr>
        </thead>

        <tbody>
        @forelse($pengurus as $p)
        <tr class="text-center border-t">
            <td class="p-2">{{ $loop->iteration }}</td>
            <td class="p-2">{{ $p->id }}</td>
            <td class="p-2">{{ $p->nama }}</td>
            <td class="p-2">{{ $p->jenisKelamin }}</td>
            <td class="p-2">{{ $p->jabatan }}</td>
            <td class="p-2">{{ $p->no_hp }}</td>
            <td class="p-2">{{ $p->email }}</td>
            <td class="p-2">{{ $p->alamat }}</td>
            
            <td class="p-2">
                <img src="{{ asset('storage/' . $p->foto) }}"
                     width="60" class="mx-auto">
            </td>

            <td class="p-2">{{ $p->bio }}</td>
            <td class="p-2">{{ $p->status }}</td>

            <td class="p-2 space-x-1">
                <a href="{{ route('pengurus.edit', $p->id) }}"
                   class="bg-yellow-400 px-2 py-1 rounded">
                    Edit
                </a>

                <form action="{{ route('pengurus.destroy', $p->id) }}"
                      method="POST" class="inline">
                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Yakin hapus?')"
                            class="bg-red-500 text-white px-2 py-1 rounded">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="10" class="text-center p-4">
                Data tidak ada
            </td>
        </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection