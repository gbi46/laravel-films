<?php

use App\Http\Controllers\Api\GenresController;
use App\Http\Controllers\Api\MoviesController;

Route::prefix('genres')->group(function () {
    Route::get('/', [GenresController::class, 'index']);
    Route::get('/{id}', [GenresController::class, 'show']);
    Route::post('/', [GenresController::class, 'store']);
    Route::put('/{id}', [GenresController::class, 'update']);
    Route::patch('/{id}', [GenresController::class, 'update']);
    Route::delete('/{id}', [GenresController::class, 'destroy']);
});

Route::prefix('movies')->group(function () {
    Route::get('/', [MoviesController::class, 'index']);
    Route::get('/{id}', [MoviesController::class, 'show']);
    Route::post('/', [MoviesController::class, 'store']);
    Route::put('/{id}', [MoviesController::class, 'update']);
    Route::patch('/{id}', [MoviesController::class, 'update']);
    Route::delete('/{id}', [MoviesController::class, 'destroy']);
});