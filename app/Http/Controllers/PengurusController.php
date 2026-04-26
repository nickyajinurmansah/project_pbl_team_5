<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengurus;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    // ✅ INDEX (tampil data)
    public function index()
    {
        $pengurus = Pengurus::all();
        return view('pengurus.index', compact('pengurus'));
    }

    // ✅ FORM CREATE
    public function create()
    {
        return view('pengurus.create');
    }

    // ✅ SIMPAN DATA
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|max:45',
        'jabatan' => 'required|max:45',
        'no_hp' => 'required|max:20',
        'email' => 'required|email|max:50',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png',
        'bio' => 'required|max:100',
        'status' => 'required|in:Aktif,non-Aktif'
    ]);

    // upload foto
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('pengurus', 'public');
    } else {
        $foto = 'default-Pengurus.jpg';
    }

    Pengurus::create([
        'nama' => $request->nama,
        'jabatan' => $request->jabatan,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'foto' => $foto,
        'bio' => $request->bio,
        'status' => $request->status
    ]);

    return redirect()->route('pengurus.index')->with('success', 'Data berhasil ditambah');
}

    // ✅ FORM EDIT
    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('pengurus.edit', compact('pengurus'));
    }

    // ✅ UPDATE DATA
    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $request->validate([
            'nama' => 'required|max:45',
            'jabatan' => 'required|max:45',
            'no_hp' => 'required|max:20',
            'email' => 'required|email|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png',
            'bio' => 'required|max:100',
            'status' => 'required|in:Aktif,non-Aktif'
        ]);

        // cek jika upload foto baru
        if ($request->hasFile('foto')) {
            // hapus foto lama (kalau bukan default)
            if ($pengurus->foto && $pengurus->foto != 'default-Pengurus.jpg') {
                Storage::delete('public/' . $pengurus->foto);
            }

            $foto = $request->file('foto')->store('pengurus', 'public');
        } else {
            $foto = $pengurus->foto;
        }

        $pengurus->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'foto' => $foto,
            'bio' => $request->bio,
            'status' => $request->status
        ]);

        return redirect()->route('pengurus.index')->with('success', 'Data berhasil diupdate');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);

        // hapus foto (kalau bukan default)
        if ($pengurus->foto && $pengurus->foto != 'default-Pengurus.jpg') {
            Storage::delete('public/' . $pengurus->foto);
        }

        $pengurus->delete();

        return redirect()->route('pengurus.index')->with('success', 'Data berhasil dihapus');
    }
}