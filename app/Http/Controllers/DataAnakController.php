<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_anak = DataAnak::latest()->paginate(10);
        
        // Hitung statistik
        $totalAnak = DataAnak::count();
        $internal = DataAnak::where('kategori_anak', 'Internal')->count();
        $external = DataAnak::where('kategori_anak', 'External')->count();
        
        return view('data-anak.index', compact('data_anak', 'totalAnak', 'internal', 'external'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-anak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NIK' => 'required|size:16|unique:data_anak,NIK',
            'nama' => 'required|string|max:45',
            'tgl_lahir' => 'required|date',
            'jns_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string|max:45',
            'tgl_masuk' => 'required|date',
            'status' => 'required|in:Aktif,Alumni,Pindah',
            'nama_Ortu' => 'nullable|string|max:45',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'kategori_anak' => 'required|in:Internal,External',
        ], [
            'NIK.required' => 'NIK harus diisi',
            'NIK.size' => 'NIK harus 16 karakter',
            'NIK.unique' => 'NIK sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'tgl_lahir.required' => 'Tanggal lahir harus diisi',
            'jns_kelamin.required' => 'Jenis kelamin harus diisi',
            'tgl_masuk.required' => 'Tanggal masuk harus diisi',
            'status.required' => 'Status harus diisi',
            'kategori_anak.required' => 'Kategori anak harus diisi',
        ]);

        // Handle upload foto
        if ($request->hasFile('Foto')) {
            $fotoPath = $request->file('Foto')->store('fotos/anak', 'public');
            $validated['Foto'] = $fotoPath;
        }

        DataAnak::create($validated);

        return redirect()->route('data-anak.index')
            ->with('success', 'Data anak berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataAnak $data_anak)
    {
        return view('data-anak.show', compact('data_anak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataAnak $data_anak)
    {
        return view('data-anak.edit', compact('data_anak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataAnak $data_anak)
    {
        $validated = $request->validate([
            'NIK' => 'required|digits:16|unique:data_anak,NIK,' . $data_anak->idanak_panti . ',idanak_panti',
            'nama' => 'required|string|max:45',
            'tgl_lahir' => 'required|date',
            'jns_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string|max:45',
            'tgl_masuk' => 'required|date',
            'status' => 'required|in:Aktif,Alumni,Pindah',
            'nama_Ortu' => 'nullable|string|max:45',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_anak' => 'required|in:Internal,External',
        ]);

        // Handle upload foto baru
        if ($request->hasFile('Foto')) {
            // Hapus foto lama jika ada
            if ($data_anak->Foto) {
                Storage::disk('public')->delete($data_anak->Foto);
            }
            $fotoPath = $request->file('Foto')->store('fotos/anak', 'public');
            $validated['Foto'] = $fotoPath;
        }

        $data_anak->update($validated);

        return redirect()->route('data-anak.index')
            ->with('success', 'Data anak berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataAnak $data_anak)
    {
        // Hapus foto jika ada
        if ($data_anak->Foto) {
            Storage::disk('public')->delete($data_anak->Foto);
        }

        $data_anak->delete();

        return redirect()->route('data-anak.index')
            ->with('success', 'Data anak berhasil dihapus!');
    }

    
}