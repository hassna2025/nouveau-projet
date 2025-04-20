<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController; // Au lieu de Api\CategoryController
use App\Http\Controllers\Api\AuthController;

Route::middleware(['api'])->group(function () {
    // Authentification
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // Routes protégées
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        
        // Utilisez directement CategoryController sans le sous-namespace Api
        Route::apiResource('categories', CategoryController::class);
        Route::get('categories/list/select', [CategoryController::class, 'list']);
    });
});

Route::fallback(function () {
    return response()->json(['message' => 'Endpoint non trouvé'], 404);
});