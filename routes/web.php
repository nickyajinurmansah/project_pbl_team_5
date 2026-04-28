<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengurusController; //
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\DataAnakController; // data anak

Route::get('/', function () {
    return view('welcome');
});

// 🔹 Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    // 🔹 Route pengurus (CRUD)
    Route::resource('pengurus', PengurusController::class)
    ->middleware(['auth']); // opsional, biar harus login dulu
    
    // 🔹 Route data-anak (CRUD)
    Route::resource('data-anak', DataAnakController::class)->middleware(['auth']);
    
    // 🔹 Route donatur (CRUD)
    Route::middleware('auth')->group(function (){
      Route::resource('donatur', DonaturController::class);
    });
    // 🔹 Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';