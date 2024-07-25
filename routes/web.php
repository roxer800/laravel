<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/vacancys/create', [VacancyController::class, 'create'])->name('vacancy.create');

Route::get('/vacancys', [VacancyController::class, 'index'])->name('vacancy.index');
Route::get('/vacancys/{vacancy}', [VacancyController::class, 'show'])->name('vacancy.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/vacancys', [VacancyController::class, 'store'])->name('vacancy.store');

    Route::put('/vacancys/{vacancy}', [VacancyController::class, 'update'])->name('vacancy.update');
    Route::get('/vacancys/{vacancy}/edit', [VacancyController::class, 'edit'])->name('vacancy.edit');
    Route::delete('/vacancys/{vacancy}', [VacancyController::class, 'destroy'])->name('vacancy.destroy');
    Route::post('/vacancies/{id}/apply', [VacancyController::class, 'apply']);
    Route::get('/vacancys.my-vacancy', [VacancyController::class, 'myVacancy'])->name('vacancy.myVacancy');;
    Route::get('/vacancys.submissions', [VacancyController::class, 'submissions'])->name('vacancy.submissions');;
    Route::get('/vacancys.registered-vacancy', [VacancyController::class, 'registeredVacancy'])->name('vacancy.registeredVacancy');;
});

require __DIR__ . '/auth.php';
