<?php

// AdminController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by type if provided
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->get();

        return view('admin.users', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.edit_user', compact('user'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'type' => 'required|in:A,E,C',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users')
            ->with('alert-msg', 'User updated successfully!')
            ->with('alert-type', 'success');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'type' => 'required|in:A,E',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Ensure only Admin and Employee can be deleted
        if (in_array($user->type, ['A', 'E'])) {
            $user->delete();
        }

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
}

