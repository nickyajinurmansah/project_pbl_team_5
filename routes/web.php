<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengurusController; //

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

// 🔹 Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// data anak
use App\Http\Controllers\DataAnakController;

Route::get('/', function () {
    return redirect()->route('data-anak.index');
});

Route::resource('data-anak', DataAnakController::class);