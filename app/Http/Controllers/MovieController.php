<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genre')->whereHas('screenings', function ($query) {
            $query->whereDate('date', '>=', now());
        })->get();

        return view('movies.index', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::with('screenings.theater')->findOrFail($id);
        return response()->json($movie, 200);
    }
}
