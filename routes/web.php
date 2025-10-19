<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostWebController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return redirect('/posts');
});

// Rutas Web
Route::get('/posts', [PostWebController::class, 'index'])->name('posts.index');
Route::get('/posts/crear', [PostWebController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostWebController::class, 'store'])->name('posts.store');

// Rutas API (separadas con prefijo api)
Route::prefix('api')->middleware('auth:api')->group(function () {
    Route::get('posts', [PostController::class, 'index']);
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
});
