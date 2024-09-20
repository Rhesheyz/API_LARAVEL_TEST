<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\PemilikPostingan;

// Routes that require authentication
Route::middleware(['auth:sanctum'])->group(function() {
    
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::post('me', [AuthenticationController::class, 'me']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/posts/{id}', [PostController::class, 'update'])->middleware(PemilikPostingan::class);
    Route::post('/posts/{id}/delete', [PostController::class, 'destroy'])->middleware(PemilikPostingan::class);
});

// Public routes
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

// Authentication route
Route::post('login', [AuthenticationController::class, 'login']);
