<?php

namespace App\Http\Controllers;

use App\Models\AnakPanti;
use Illuminate\Http\Request;


//Controller untuk mengelola CRUD Data Anak Panti.
 
class AnakPantiController extends Controller
{
    
    //Menampilkan halaman index (daftar semua data anak panti).
    //Mengambil data dari database menggunakan Eloquent ORM, diurutkan dari yang terbaru.
    
    public function index()
    {
        // Mengambil semua record atau kumpulan data dari tabel data_anak, urutkan berdasarkan created_at DESC
        $data = AnakPanti::orderBy('created_at', 'desc')->get();
        
        // Mengirim data ke tampilan
        return view('anak_panti.index', compact('data'));
    }

    
    //Menampilkan form untuk menambah data anak panti baru.
    
    public function create()
    {
        return view('anak_panti.create');
    }

    
     //Apabila data valid akan menyimpan data baru ke database setelah melakukan validasi.
     //Dipanggil saat form create disubmit (POST request).
     
    public function store(Request $request)
    {
        // Validasi input dari form sebelum disimpan
        $request->validate([
            'nama'        => 'required|string|max:45',
            'NIK'         => 'required|size:16|unique:data_anak,NIK', // Unik, panjang 16 karakter
            'jns_kelamin' => 'required|in:L,P',
            'kategori_anak' => 'required|in:Internal,External',
        ]);

        //Menyimpan semua input yang lolos validasi ke tabel data_anak
        AnakPanti::create($request->all());

        //Kembali ke halaman index dengan pesan sukses
        return redirect()->route('anak_panti.index')->with('success', 'Data anak berhasil ditambahkan.');
    }

    
    //Menampilkan detail satu data anak (placeholder, bisa dikembangkan nanti).
    
    public function show(AnakPanti $anakPanti)
    {
        return view('anak_panti.show', compact('anakPanti'));
    }

    
    //Menampilkan form edit untuk satu data anak.
    //Route Model Binding otomatis mengambil data berdasarkan ID.
    
    public function edit(AnakPanti $anakPanti)
    {
        return view('anak_panti.edit', compact('anakPanti'));
    }

    
    //Mengupdate data yang sudah ada di database.
    //Dipanggil saat form edit disubmit (PUT/PATCH request).
    
    public function update(Request $request, AnakPanti $anakPanti)
    {
        // Validasi bisa ditambahkan di sini jika diperlukan
        $anakPanti->update($request->all());
        return redirect()->route('anak_panti.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    
    //Menghapus satu data anak dari database.
    //Dipanggil saat tombol hapus ditekan (DELETE request).
     
    public function destroy(AnakPanti $anakPanti)
    {
        $anakPanti->delete();
        return redirect()->route('anak_panti.index')->with('success', 'Data anak berhasil dihapus.');
    }
}