<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\Customer;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        return view('statistics.index');
    }

    public function ticketSalesByMonth()
    {
        $ticketSalesByMonth = DB::table('tickets')
            ->join('purchases', 'tickets.purchase_id', '=', 'purchases.id')
            ->select(
                DB::raw('YEAR(purchases.date) as year'),
                DB::raw('MONTH(purchases.date) as month'),
                DB::raw('ROUND(SUM(tickets.price)) as total_sales')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);
    
        return view('statistics.ticketSalesByMonth', compact('ticketSalesByMonth'));
    }
    
    public function ticketSalesByYear()
    {
        $ticketSalesByYear = DB::table('tickets')
            ->join('purchases', 'tickets.purchase_id', '=', 'purchases.id')
            ->select(
                DB::raw('YEAR(purchases.date) as year'),
                DB::raw('ROUND(SUM(tickets.price)) as total_sales')
            )
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->paginate(10);
    
        return view('statistics.ticketSalesByYear', compact('ticketSalesByYear'));
    }    

    public function averageSalesByMovie(Request $request)
    {
        $filterByGenre = $request->input('genre');
        $filterByName = $request->input('name');

        $query = Movie::join('screenings', 'movies.id', '=', 'screenings.movie_id')
            ->join('tickets', 'screenings.id', '=', 'tickets.screening_id')
            ->select('movies.title', DB::raw('AVG(tickets.price) as average_sales'));

        if ($filterByGenre) {
            $query->where('movies.genre_code', $filterByGenre);
        }

        if ($filterByName) {
            $query->where('movies.title', 'like', '%' . $filterByName . '%');
        }

        $averageSalesByMovie = $query->groupBy('movies.title')
            ->orderBy('average_sales', 'desc')
            ->paginate(10, ['*'], 'movies_page');

        $genres = Genre::all();

        return view('statistics.averageSalesByMovie', compact('averageSalesByMovie', 'genres', 'filterByGenre', 'filterByName'));
    }

    public function salesByCustomer()
    {
        $salesByCustomer = Customer::join('users', 'customers.id', '=', 'users.id')
            ->join('purchases', 'customers.id', '=', 'purchases.customer_id')
            ->join('tickets', 'purchases.id', '=', 'tickets.purchase_id')
            ->select('users.name', DB::raw('SUM(tickets.price) as total_spent'))
            ->groupBy('users.name')
            ->orderBy('total_spent', 'desc')
            ->paginate(10, ['*'], 'customers_page');

        return view('statistics.salesByCustomer', compact('salesByCustomer'));
    }
}
