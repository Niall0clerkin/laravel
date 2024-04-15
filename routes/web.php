<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProfileController;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    DebugBar::info('Showing the Message!');
    return view('welcome');

    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/notes', NotesController::class);

    Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');
    Route::get('/notes/{id}', [NotesController::class, 'show'])->name('notes.show');
    Route::get('/notes/create', [NotesController::class, 'create'])->name('notes.create');
    Route::get('/notes/{id}/edit', [NotesController::class, 'edit'])->name('notes.edit');
    Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');
    Route::put('/notes/{id}', [NotesController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{id}', [NotesController::class, 'destroy'])->name('notes.destroy');
});

require __DIR__.'/auth.php';
