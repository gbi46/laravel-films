<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Genre::all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $genre = Genre::with('movies')->findOrFail($id);
        return response()->json($genre);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:genres,name',
        ]);

        $genre = Genre::create($data);

        return response()->json($genre, 201); // 201 Created
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $genre = Genre::findOrFail($id);

        $data = $request->validate([
            'name' => 'string|unique:genres,name,'.$id,
        ]);

        $genre->update($data);

        return response()->json($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return response()->json(['message' => 'Genre deleted successfully'], 204); // 204 No Content
    }

    /**
     * Create new movie
     */
    public function createMovie(Request $request, $genreId)
{
    $genre = Genre::findOrFail($genreId);

    $validatedData = $request->validate([
        'title' => [
            'required',
            'string',
        ],
        'description' => 'nullable|string',
        'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_published' => 'boolean',
    ]);

    if ($request->hasFile('poster')) {
        $posterPath = $request->file('poster')->store('movie_posters', 'public');
        $validatedData['poster'] = $posterPath;
    } else {
        $validatedData['poster'] = 'default.jpg';
    }

    $movie = new Movie($validatedData);
    $movie->save();

    $movie->genres()->attach($genre->id); 

    return response()->json($movie, 201);
}
}