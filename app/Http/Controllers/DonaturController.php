<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonaturController extends Controller
{
    public function index()
    {
        $donaturs     = Donatur::latest('id_donatur')->paginate(10);
        $totalDonatur = Donatur::count();
        $donaturTetap = 0; // sesuaikan jika ada kolom status

        return view('donatur.index', compact('donaturs', 'totalDonatur', 'donaturTetap'));
    }

    public function create()
    {
        return view('donatur.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:45',
            'no_hp'        => 'nullable|string|max:15',
            'email'        => 'nullable|email|max:45',
            'alamat'       => 'nullable|string|max:45',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Proses upload foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('donatur', 'public');
        }

        Donatur::create($validated);

        return redirect()->route('donatur.index')
            ->with('success', 'Donatur berhasil ditambahkan!');
    }

    public function show(Donatur $donatur)
    {
        return view('donatur.show', compact('donatur'));
    }

    public function edit(Donatur $donatur)
    {
        return view('donatur.edit', compact('donatur'));
    }

    public function update(Request $request, Donatur $donatur)
    {
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:45',
            'no_hp'        => 'nullable|string|max:15',
            'email'        => 'nullable|email|max:45|unique:donatur,email,' . $donatur->id_donatur . ',id_donatur',
            'alamat'       => 'nullable|string|max:45',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Proses upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($donatur->foto) {
                Storage::disk('public')->delete($donatur->foto);
            }
            $validated['foto'] = $request->file('foto')->store('donatur', 'public');
        }

        $donatur->update($validated);

        return redirect()->route('donatur.index')
            ->with('success', 'Donatur berhasil diupdate!');
    }

    public function destroy(Donatur $donatur)
    {
        // Hapus foto dari storage saat donatur dihapus
        if ($donatur->foto) {
            Storage::disk('public')->delete($donatur->foto);
        }

        $donatur->delete();

        return redirect()->route('donatur.index')
            ->with('success', 'Donatur berhasil dihapus!');
    }
}