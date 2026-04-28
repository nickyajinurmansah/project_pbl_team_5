<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DataAnakController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');

    $data_anak = DataAnak::when($search, function ($query, $search) {
        return $query->where('NIK', 'like', "%{$search}%")
                     ->orWhere('nama_lengkap', 'like', "%{$search}%")
                     ->orWhere('nama_ayah', 'like', "%{$search}%")
                     ->orWhere('nama_ibu', 'like', "%{$search}%");
    })
    ->orderBy('idanak_panti', 'desc')  // ← GANTI latest() dengan ini
    ->paginate(10);

    // Hitung statistik
    $totalAnak = DataAnak::count();
    $internal = DataAnak::where('kategori_anak', 'Internal')->count();
    $external = DataAnak::where('kategori_anak', 'External')->count();
    
    return view('data-anak.index', compact('data_anak', 'totalAnak', 'internal', 'external', 'search'));
}
    public function create()
    {
        return view('data-anak.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'NIK' => 'required|numeric|digits:16|unique:data_anak,NIK',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => [
                'required', 
                'date', 
                'after:1990-01-01',
                'before:today'
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',  // ← PERBAIKAN
            'alamat' => 'nullable|string|max:255',
            'tanggal_masuk' => 'required|date|before_or_equal:today',
            'status' => 'required|in:Aktif,Tidak Aktif',
            
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'alamat_orang_tua' => 'nullable|string|max:255',
            
            'foto_anak' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',  // ← PERBAIKAN
            'kategori_anak' => 'required|in:Internal,External',
        ], [
            'NIK.required' => 'NIK harus diisi',
            'NIK.numeric' => 'NIK hanya boleh berisi angka',
            'NIK.digits' => 'NIK harus tepat 16 digit angka',
            'NIK.unique' => 'NIK sudah terdaftar',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.after' => 'Tanggal lahir tidak valid',
            'tanggal_lahir.before' => 'Tanggal lahir tidak boleh di masa depan',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',  // ← PERBAIKAN
            'tanggal_masuk.required' => 'Tanggal masuk harus diisi',
            'status.required' => 'Status harus diisi',
            'kategori_anak.required' => 'Kategori anak harus diisi',
        ]);

        // Validasi: Minimal Ayah ATAU Ibu harus diisi
        if (empty($request->nama_ayah) && empty($request->nama_ibu)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nama_ayah' => 'Harap isi minimal Nama Ayah atau Nama Ibu!']);
        }

        // Handle upload foto
        if ($request->hasFile('foto_anak')) {  // ← PERBAIKAN
            $fotoPath = $request->file('foto_anak')->store('fotos/anak', 'public');  // ← PERBAIKAN
            $validated['foto_anak'] = $fotoPath;  // ← PERBAIKAN
        }

        DataAnak::create($validated);

        return redirect()->route('data-anak.index')
            ->with('success', 'Data anak berhasil ditambahkan!');
    }

    public function show(DataAnak $data_anak)
    {
        return view('data-anak.show', compact('data_anak'));
    }

    public function edit(DataAnak $data_anak)
    {
        return view('data-anak.edit', compact('data_anak'));
    }

    public function update(Request $request, DataAnak $data_anak)
    {
        $validated = $request->validate([
            'NIK' => [
                'required', 
                'numeric', 
                'digits:16', 
                Rule::unique('data_anak', 'NIK')->ignore($data_anak->idanak_panti, 'idanak_panti')
            ],
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => [
                'required', 
                'date', 
                'after:1990-01-01',
                'before:today'
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',  // ← PERBAIKAN
            'alamat' => 'nullable|string|max:255',
            'tanggal_masuk' => 'required|date|before_or_equal:today',
            'status' => 'required|in:Aktif,Tidak Aktif',
            
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'alamat_orang_tua' => 'nullable|string|max:255',
            
            'foto_anak' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // ← PERBAIKAN
            'kategori_anak' => 'required|in:Internal,External',
        ]);

        // Validasi: Minimal Ayah ATAU Ibu harus diisi
        if (empty($request->nama_ayah) && empty($request->nama_ibu)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nama_ayah' => 'Harap isi minimal Nama Ayah atau Nama Ibu!']);
        }

        // Handle upload foto
        if ($request->hasFile('foto_anak')) {  // ← PERBAIKAN
            if ($data_anak->foto_anak) {  // ← PERBAIKAN
                Storage::disk('public')->delete($data_anak->foto_anak);  // ← PERBAIKAN
            }
            $fotoPath = $request->file('foto_anak')->store('fotos/anak', 'public');  // ← PERBAIKAN
            $validated['foto_anak'] = $fotoPath;  // ← PERBAIKAN
        }

        $data_anak->update($validated);

        return redirect()->route('data-anak.index')
            ->with('success', 'Data anak berhasil diupdate!');
    }

    public function destroy(DataAnak $data_anak)
    {
        if ($data_anak->foto_anak) {  // ← PERBAIKAN
            Storage::disk('public')->delete($data_anak->foto_anak);  // ← PERBAIKAN
        }

        $data_anak->delete();

        return redirect()->route('data-anak.index')
            ->with('success', 'Data anak berhasil dihapus!');
    }
}