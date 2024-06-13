<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\Movie;
use App\Models\Theater;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    public function index()
    {
        $screenings = Screening::with(['movie', 'theater'])->get();
        return view('screenings.index', compact('screenings'));
    }

    public function create()
    {
        $movies = Movie::all();
        $theaters = Theater::all();
        return view('screenings.create', compact('movies', 'theaters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theater_id' => 'required|exists:theaters,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
        ]);

        Screening::create($request->all());

        return redirect()->route('screenings.index')->with('success', 'Screening created successfully.');
    }

    public function show(Screening $screening)
    {
        return view('screenings.show', compact('screening'));
    }

    public function edit(Request $request, Screening $screening)
    {
        //dd($request->all());
        $movies = Movie::all();
        $theaters = Theater::all();
        return view('screenings.edit', compact('screening', 'movies', 'theaters'));
    }

    public function update(Request $request, Screening $screening)
    {
        if ($screening->tickets()->exists()) {
            return redirect()->route('screenings.index')->with('error', 'Cannot update screening, tickets have already been sold.');
        }

        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theater_id' => 'required|exists:theaters,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
        ]);
        $screening->update($request->all());

        return redirect()->route('screenings.index')->with('success', 'Screening updated successfully.');
    }

    public function destroy(Screening $screening)
    {
        if ($screening->tickets()->exists()) {
            return redirect()->route('screenings.index')->with('error', 'Cannot delete screening, tickets have already been sold.');
        }
        $screening->delete();
        return redirect()->route('screenings.index')->with('success', 'Screening deleted successfully.');
    }
}
