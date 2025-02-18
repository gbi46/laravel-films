<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'poster' => 'nullable|image',
            'is_published' => 'boolean',
            'genres' => 'array',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        } else {
            $data['poster'] = 'default.jpg';
        }

        $movie = Movie::create($data);
        $movie->genres()->attach($request->genres);

        return response()->json($movie, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $data = $request->validate([
            'title' => 'string',
            'poster' => 'nullable|image',
            'is_published' => 'boolean',
            'genres' => 'array',
        ]);

        if ($request->hasFile('poster')) {
            Storage::delete($movie->poster);
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $movie->update($data);
        if (isset($request->genres)) {
            $movie->genres()->sync($request->genres);
        }

        return response()->json($movie);
    }

    public function publish($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update(['is_published' => true]);
        return response()->json(['message' => 'Фильм опубликован']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->poster !== 'default.jpg' && Storage::exists('public/' . $movie->poster)) {
            Storage::delete('public/' . $movie->poster);
        }

        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully'], 204);
    }
}
