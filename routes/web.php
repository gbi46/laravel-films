<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::resource('genres', GenreController::class)->names([
    'index' => 'genres.index',
    'create' => 'genres.create',
    'store' => 'genres.store',
    'show' => 'genres.show',
    'edit' => 'genres.edit',
    'update' => 'genres.update',
    'destroy' => 'genres.destroy'
]);

Route::get('/', function () {
    return view('welcome');
});


Route::get('genres/index', [GenreController::class, 'index']);
Route::post('genres/create', [GenreController::class, 'store']);
Route::put('genres/edit/{id}', [GenreController::class, 'update']);
Route::post('genres/delete/{id}', [GenreController::class, 'destroy']);
Route::get('genres/{genreId}/movies/create', [GenreController::class, 'createMovie'])->name('genres.movies.create');

Route::resource('movies', MovieController::class)->names([
    'index' => 'movies.index',
    'create' => 'movies.create',
    'store' => 'movies.store',
    'show' => 'movies.show',
    'edit' => 'movies.edit',
    'update' => 'movies.update',
    'destroy' => 'movies.destroy',
    'publish' => 'movies.publish'
]);

Route::get('movies/index', [MovieController::class, 'index']);
Route::get('movies/{id}', [MovieController::class, 'show']);
Route::get('movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::patch('movies/{id}', [MovieController::class, 'update']);
Route::post('movies/delete/{id}', [MovieController::class, 'destroy']);
Route::patch('movies/{id}/publish', [MovieController::class, 'publish'])->name('movies.publish');

