<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnakPantiController extends Controller
{
    public function index()
{
    // Mengambil semua data dari model Anak
    // $data_anak = Anak::all(); 
    return view('anak.index'); // Mengarah ke file resources/views/anak/index.blade.php
}
}
