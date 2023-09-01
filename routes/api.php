<?php

use App\Http\Controllers\Api\DriveController;
use App\Http\Controllers\authApi\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('drives', [DriveController::class, 'index']);
    Route::post('drives', [DriveController::class, 'store']);
    Route::post('drives/{id}', [DriveController::class, 'update']);
    Route::delete('drives/{id}', [DriveController::class, 'destroy']);
    Route::post('login', [AuthController::class, 'login']);
});
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
