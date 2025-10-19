<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);
});


Route::middleware('auth')->group(function () {
    Route::patch('/tasks/{task}/status', [TaskController::class, 'update'])
        ->name('tasks.updateStatus')
        ->middleware('can:update,task');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy')
        ->middleware('can:delete,task');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


require __DIR__.'/auth.php';
