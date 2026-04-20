<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/generate', [SalesPageController::class, 'create']);
Route::post('/generate', [SalesPageController::class, 'store']);
Route::post('/save', [SalesPageController::class, 'save']);
Route::get('/detail/{id}', [SalesPageController::class, 'show']);
Route::get('/edit/{id}', [SalesPageController::class, 'edit']);
Route::post('/edit/{id}', [SalesPageController::class, 'update']);
Route::delete('/pages/{id}', [SalesPageController::class, 'destroy']);
Route::get('/', [SalesPageController::class, 'index'])->middleware('auth');
Route::get('/export/{id}', [SalesPageController::class, 'export']);

require __DIR__.'/auth.php';
