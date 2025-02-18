<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the genres.
     */
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new genre.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created genre in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:genres,name',
        ]);

        Genre::create($validatedData);

        return redirect()->route('genres.index')->with('success', 'Genre created successfully.');
    }

    /**
     * Display the specified genre.
     */
    public function show($id)
    {
        $genre = Genre::with('movies')->findOrFail($id);
        return view('genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified genre.
     */
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified genre in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:genres,name,' . $id,
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update($validatedData);

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');
    }

    /**
     * Remove the specified genre from storage.
     */
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully.');
    }

    /**
     * Show the form for creating a new movie for the specified genre.
     */
    public function createMovie($genreId)
    {
        $genre = Genre::findOrFail($genreId);
        $genres = Genre::all();
        return view('movies.create', compact('genre', 'genres'));
    }

    /**
     * Store a newly created movie for the specified genre.
     */
    public function storeMovie(Request $request, $genreId)
    {
        $genre = Genre::findOrFail($genreId);

        $validatedData = $request->validate([
            'title' => 'required|string',
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

        return redirect()->route('genres.show', $genreId)->with('success', 'Movie created successfully.');
    }
}