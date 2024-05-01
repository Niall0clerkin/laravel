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


Route::post('/vacancies/{id}/reupload', [VacanciesController::class, 'reupload'])->name('vacancies.reupload');

route::get('/vacancies/deletedindex', [VacanciesController::class, 'deletedIndex'])->name('vacancies.deletedindex');


Route::get('/userindex', [VacanciesController::class, 'indexUser'])->name('vacancies.userindex');

Route::resource('/vacancies', VacanciesController::class);

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
Route::post('/notes/{note}/comments', [CommentsController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';
