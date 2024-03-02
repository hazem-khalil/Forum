<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadsController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\FavoritesController;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('/threads', ThreadsController::class);
Route::get('/threads', [ThreadsController::class, 'index']);
Route::get('/threads/create', [ThreadsController::class, 'create']);
Route::get('/threads/{channel}', [ThreadsController::class, 'index']);
Route::get('/threads/{channel}/{thread}', [ThreadsController::class, 'show']);
Route::delete('/threads/{channel}/{thread}', [ThreadsController::class, 'destroy']);
Route::post('/threads', [ThreadsController::class, 'store']);

Route::post('/threads/{channel}/{thread}/replies', [RepliesController::class, 'store']);
Route::delete('/replies/{reply}', [RepliesController::class, 'destroy']);

Route::post('/replies/{reply}/favorites', [FavoritesController::class, 'store']);

require __DIR__.'/auth.php';
