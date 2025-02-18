<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller as BaseController;

class GenresController extends BaseController
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
}