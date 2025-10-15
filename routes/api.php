<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('registrar', [AuthController::class, 'registrar']);
Route::post('iniciar-sesion', [AuthController::class, 'iniciarSesion']);

Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});
