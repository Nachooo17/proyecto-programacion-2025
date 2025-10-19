<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::post('registrar', [AuthController::class, 'registrar']);
Route::post('iniciar-sesion', [AuthController::class, 'iniciarSesion']);

Route::middleware('auth:api')->group(function () {
    Route::get('usuario', function () {
        return auth()->user();
    });

    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{id}', [PostController::class, 'show']);
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
});
