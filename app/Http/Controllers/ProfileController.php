<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Customer;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $customer = $user->customer;

        if ($customer == null) {
            $customer = new Customer();
            $customer->id = $user->id;
        }

        return view('profile.edit', compact('user', 'customer'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo_filename')) {
            // Delete old photo if exists
            if ($user->photo_filename) {
                Storage::delete('public/photos/' . $user->photo_filename);
            }

            $fileName = time() . '.' . $request->photo_filename->extension();
            $request->photo_filename->storeAs('public/photos', $fileName);
            $user->photo_filename = $fileName;
        }

        $user->save();

        $customer = $user->customer;
        if ($customer == null) {
            $customer = new Customer();
            $customer->id = $user->id;
        }

        $customer->nif = $request->nif;
        $customer->payment_ref = $request->payment_ref;
        $customer->save();

        return redirect()->route('profile.edit')
            ->with('alert-msg', 'Profile updated successfully!')
            ->with('alert-type', 'success');
    }
}



