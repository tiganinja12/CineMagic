<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    public function index(Request $request)
    {
        $query = Theater::query()->withTrashed();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $theaters = $query->get();

        return view('theaters.index', compact('theaters'));
    }

    public function create()
    {
        return view('theaters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo_filename' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $theater = new Theater();
        $theater->name = $request->name;

        if ($request->hasFile('photo_filename')) {
            $path = $request->file('photo_filename')->store('photos', 'public');
            $theater->photo_filename = $path;
        }

        $theater->save();

        return redirect()->route('theaters.index')->with('success', 'Theater created successfully!');
    }

    public function edit($id)
    {
        $theater = Theater::withTrashed()->findOrFail($id);

        return view('theaters.edit', compact('theater'));
    }

    public function show($id)
    {
        $theater = Theater::with('seats')->findOrFail($id);
        return view('theaters.show', compact('theater'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo_filename' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $theater = Theater::withTrashed()->findOrFail($id);
        $theater->name = $request->name;

        if ($request->hasFile('photo_filename')) {
            $path = $request->file('photo_filename')->store('photos', 'public');
            $theater->photo_filename = $path;
        }

        $theater->save();

        return redirect()->route('theaters.index')->with('success', 'Theater updated successfully!');
    }

    public function softDelete($id)
    {
        $theater = Theater::findOrFail($id);
        $theater->delete();

        return redirect()->route('theaters.index')->with('success', 'Theater soft deleted successfully!');
    }

    public function restore($id)
    {
        $theater = Theater::withTrashed()->findOrFail($id);
        $theater->restore();

        return redirect()->route('theaters.index')->with('success', 'Theater restored successfully!');
    }
}


