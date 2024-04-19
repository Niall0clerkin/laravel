<?php
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\VacanciesController;
use App\Http\Controllers\ProfileController;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    DebugBar::info('Showing the Message!');
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/vacancies/indexuser', function () {
    return view('vacancies.indexuser');
})->name('vacancies.indexuser');

Route::get('/vacancies/deletedindex',)->name('vacancies.deletedindex');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/vacancies', VacanciesController::class);
    Route::post('/vacancies/{vacancy}/comments', [CommentsController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';
