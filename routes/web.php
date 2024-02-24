<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadsController;

Route::get('/threads', [ThreadsController::class, 'index']);
Route::get('/threads/{thread}', [ThreadsController::class, 'show']);
