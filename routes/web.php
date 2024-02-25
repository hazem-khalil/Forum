<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadsController;
use App\Http\Controllers\RepliesController;

Route::get('/threads', [ThreadsController::class, 'index']);
Route::get('/threads/{thread}', [ThreadsController::class, 'show']);
Route::post('/threads/{thread}/replies', [RepliesController::class, 'store']);