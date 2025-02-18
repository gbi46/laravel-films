<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class MoviesController extends BaseController
{
    public function createMovie(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'genre_id' => 'required|exists:genres,id',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('movie_posters', 'public');
        } else {
            $data['poster'] = 'default.jpg';
        }

        $movie = Movie::create($data);

        return response()->json($movie, 201);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Movie::with('genres')->paginate(10));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::with('genres')->findOrFail($id);
        return response()->json($movie);
    }
}
