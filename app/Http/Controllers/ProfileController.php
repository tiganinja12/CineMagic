<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $customer = $user->customer;

        return view('profile.edit', compact('user', 'customer'));
    }

    public function edit()
    {
        $user = auth()->user();
        $customer = $user->customer;

        return view('profile.edit', compact('user', 'customer'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $customer = $user->customer;

        if ($customer) {
            // Update existing customer details
            $customer->fill($request->only(['nif', 'payment_type', 'payment_ref']));
            $customer->save();
        }

        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('photo_filename')) {
            $path = $request->file('photo_filename')->store('photos', 'public');
            $user->photo_filename = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')
            ->with('alert-msg', 'Profile updated successfully!')
            ->with('alert-type', 'success');
    }

}
