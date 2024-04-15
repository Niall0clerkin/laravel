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
});

require __DIR__.'/auth.php';
