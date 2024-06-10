<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        $movie = new Movie();
        $genres = Genre::all();
        return view('movies.create', compact('movie', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'year' => 'required|integer',
            'genre_code' => 'required|string|exists:genres,code',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $posterPath = $request->file('poster') ? $request->file('poster')->store('posters') : null;

        Movie::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'year' => $request->year,
            'genre_code' => $request->genre_code,
            'poster_filename' => $posterPath,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully.');
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre_code' => 'required|string',
            'year' => 'required|integer',
            'synopsis' => 'required|string',
            'poster' => 'image|nullable',
        ]);

        $movie->fill($request->all());
        if ($request->hasFile('poster')) {
            $movie->poster_filename = $request->file('poster')->store('posters', 'public');
        }
        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully');
    }
}




