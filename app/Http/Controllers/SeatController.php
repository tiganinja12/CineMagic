<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Theater;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function create($theaterId)
    {
        $theater = Theater::findOrFail($theaterId);
        return view('theaters.seats.create', compact('theater'));
    }

    public function store(Request $request, $theaterId)
    {
        $theater = Theater::findOrFail($theaterId);

        $request->validate([
            'row' => 'required|string|max:1',
            'seat_number' => 'required|integer|min:1',
        ]);

        $theater->seats()->create([
            'row' => $request->row,
            'seat_number' => $request->seat_number,
        ]);

        return redirect()->route('theaters.show', $theater->id)->with('success', 'Seat added successfully!');
    }

    public function bulkCreate($theaterId)
    {
        $theater = Theater::findOrFail($theaterId);
        return view('theaters.seats.bulk_create', compact('theater'));
    }

    public function bulkStore(Request $request, $theaterId)
    {
        $theater = Theater::findOrFail($theaterId);

        $request->validate([
            'start_row' => 'required|string|max:1',
            'end_row' => 'required|string|max:1',
            'start_seat' => 'required|integer|min:1',
            'end_seat' => 'required|integer|min:1',
        ]);

        $startRow = ord(strtoupper($request->start_row));
        $endRow = ord(strtoupper($request->end_row));
        $startSeat = $request->start_seat;
        $endSeat = $request->end_seat;

        for ($row = $startRow; $row <= $endRow; $row++) {
            for ($seat = $startSeat; $seat <= $endSeat; $seat++) {
                $theater->seats()->create([
                    'row' => chr($row),
                    'seat_number' => $seat,
                ]);
            }
        }

        return redirect()->route('theaters.show', $theater->id)->with('success', 'Seats added successfully!');
    }

    public function destroy($theaterId, $seatId)
    {
        $theater = Theater::findOrFail($theaterId);
        $seat = Seat::findOrFail($seatId);
        $seat->delete();

        return redirect()->route('theaters.show', $theater->id)->with('success', 'Seat deleted successfully!');
    }
}