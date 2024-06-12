<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Screening;
use App\Models\Seat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Theater;
use App\Models\Ticket;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $filterByGenre = $request->input('genre');
        $filterByTitle = $request->input('title');

        $startDate = Carbon::today();
        $endDate = Carbon::today()->addWeeks(2);
        //dd($startDate, $endDate);

        $query = Movie::whereHas('screenings', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        });

        if ($filterByGenre) {
            $query->where('genre_code', $filterByGenre);
        }

        if ($filterByTitle) {
            $query->where('title', 'like', '%' . $filterByTitle . '%');
        }

        $movies = $query->paginate(10);
        $genres = Genre::all();

        return view('movies.index', compact('movies', 'genres', 'filterByGenre', 'filterByTitle'));
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

    public function show(Request $request,Movie $movie)
    {
        $generos = Genre::pluck('name', 'code');
        $genero = $request->query('genre');
        $movie = Movie::find($movie->id);


        $data = date('Y-m-d',strtotime('-5 minutes'));
        $hora = date('H:i:s',strtotime('-5 minutes'));

        $screening_id= Screening::where('movie_id', $movie->id)->where('date', '>=', $data) ->pluck('id');

        $screenings = Screening::whereIn('id', $screening_id);

        $screenings = $screenings->paginate(6)->withQueryString();

        return view('movies.show', compact('movie','screenings'));
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    public function show_session(Request $request,Movie $movie, Screening $screening)
    {
        $genres = Genre::pluck('name', 'code');
        $genre = $request->query('genre');
        $movie = Movie::find($movie->id);
        $screening = Screening::find($screening->id);
        $theater = Theater::find($screening->theater_id);
        $seats = Seat::where('theater_id',$screening->theater_id)->get();
        $tickets = Ticket::where('screening_id',$screening->id)->get();
        $rows = Seat::select('row')->where('theater_id',$screening->theater_id)->groupBy('row')->get();
        $columns = Seat::select('row')->where('theater_id',$screening->theater_id)->distinct()->count('seat_number');
        $invalidtickets = Ticket::where('screening_id',$screening->id)->where('status',"invalid")->get();

        return view('movies.show_session', compact('movie', 'genres', 'genre','screening','seats','theater','tickets','rows','columns','invalidtickets'));
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




