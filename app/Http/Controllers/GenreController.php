<?php

namespace App\Http\Controllers;

use App\Models\Genre;
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
}