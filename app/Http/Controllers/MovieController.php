<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre; // Genre Model importieren
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the movies.
     */
    public function index()
    {
        $movies = Movie::with('genres')->paginate(10);
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new movie.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    /**
     * Store a newly created movie in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'poster' => 'nullable|image',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('movie_posters', 'public');
        } else {
            $data['poster'] = 'default.jpg';
        }

        $movie = Movie::create($data);
        $movie->genres()->attach($request->genres);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified movie.
     */
    public function show($id)
    {
        $movie = Movie::with('genres')->findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified movie.
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    /**
     * Update the specified movie in storage.
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
            $data['poster'] = $request->file('poster')->store('movie_posters', 'public');
        }

        $movie->update($data);
        if (isset($request->genres)) {
            $movie->genres()->sync($request->genres);
        }

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    /**
     * Publish the specified movie.
     */
    public function publish($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update(['is_published' => true]);
        return redirect()->route('movies.index')->with('success', 'Movie published successfully.');
    }

    /**
     * Remove the specified movie from storage.
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->poster !== 'default.jpg' && Storage::exists('public/' . $movie->poster)) {
            Storage::delete('public/' . $movie->poster);
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}