<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $genres = Genre::withTrashed()
            ->where('name', 'like', "%$search%")
            ->orWhere('code', 'like', "%$search%")
            ->get();

        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:genres',
            'name' => 'required|string|max:255',
        ]);

        Genre::create($request->all());

        return redirect()->route('genres.index')->with('success', 'Genre created successfully.');
    }

    public function edit($code)
    {
        $genre = Genre::findOrFail($code);
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre = Genre::findOrFail($code);
        $genre->update($request->all());

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');
    }

    public function destroy($code)
    {
        $genre = Genre::withCount('movies')->findOrFail($code);

        if ($genre->hasActiveScreenings()) {
            return redirect()->route('genres.index')->with('error', 'Cannot delete a genre that has active screenings.');
        }

        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully.');
    }

    public function restore($code)
    {
        $genre = Genre::withTrashed()->findOrFail($code);
        $genre->restore();

        return redirect()->route('genres.index')->with('success', 'Genre restored successfully.');
    }
}


