<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use Illuminate\Http\Request;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donaturs = Donatur::latest('id_donatur')->paginate(10);
        $totalDonatur = Donatur::count();
        
        return view('donatur.index', compact('donaturs', 'totalDonatur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donatur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:45',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:45',
            'alamat' => 'nullable|string|max:45',
        ]);

        Donatur::create($validated);

        return redirect()->route('donatur.index')
            ->with('success', 'Donatur berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donatur $donatur)
    {
        // ✅ Laravel otomatis pakai id_donatur karena sudah diset di Model
        return view('donatur.show', compact('donatur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donatur $donatur)
    {
        return view('donatur.edit', compact('donatur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donatur $donatur)
    {
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:45',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:45|unique:donatur,email,' . $donatur->id_donatur . ',id_donatur',
            'alamat' => 'nullable|string|max:45',
        ]);

        $donatur->update($validated);

        return redirect()->route('donatur.index')
            ->with('success', 'Donatur berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donatur $donatur)
    {
        $donatur->delete();

        return redirect()->route('donatur.index')
            ->with('success', 'Donatur berhasil dihapus!');
    }
}