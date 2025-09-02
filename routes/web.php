<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');
Route::get('/team/{id}', [HomeController::class, 'show'])->name('team.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('abouts', AboutController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('kategoris', KategoriController::class); // ✅ tambahkan ini
    Route::resource('contact', MessageController::class)->only(['index','show','destroy','store']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
