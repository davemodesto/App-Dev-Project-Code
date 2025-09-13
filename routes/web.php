<?php

use App\Http\Controllers\StudentController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('students.index');
    }
    return redirect()->route('login');
});

Route::get('/login', [StudentController::class, 'showLogin'])->name('login');
Route::post('/login', [StudentController::class, 'login']);
Route::get('/register', [StudentController::class, 'showRegister'])->name('register');
Route::post('/register', [StudentController::class, 'register']);
Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('students', [StudentController::class, 'store'])->name('students.store');
    Route::get('students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
});
