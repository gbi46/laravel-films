<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/apis', function() {
    return view('apis');
});

Route::get('genres', [GenreController::class, 'index']);
Route::post('/genres/{genre}/movies', [GenreController::class, 'createMovie']);
Route::get('genres/{id}', [GenreController::class, 'show']);

Route::get('movies', [MovieController::class, 'index']);
Route::get('movies/{id}', [MovieController::class, 'show']);
Route::post('movies', [MovieController::class, 'store']);
Route::patch('movies/{id}', [MovieController::class, 'update']);
Route::patch('movies/{id}/publish', [MovieController::class, 'publish']);
