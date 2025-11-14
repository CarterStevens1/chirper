<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAtrributes = $request->validate([
            'logo' => ['nullable', 'image',  File::types(['png', 'jpeg', 'jpg', 'webp']), 'max:2048'],
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],

        ]);
        if ($request->hasFile('logo')) {
            $logoPath = $request->logo->store('user-images');
            $userAtrributes['logo'] = $logoPath;
        }

        $user = User::create($userAtrributes);

        Auth::login($user);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // Edit user password
        return view('auth.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updatedAttributes = $request->validate([
            'logo' => ['nullable', 'image', File::types(['png', 'jpeg', 'jpg', 'webp']), 'max:2048'],
            'name' => ['required'],
            'current_password' => ['nullable'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);
        $returnMessage = 'Profile updated successfully!';
        $user = Auth::user();

        if ($request->hasFile('logo')) {
            $logoPath = $request->logo->store('user-images');
            $updatedAttributes['logo'] = $logoPath;
            $returnMessage = $returnMessage.' and profile picture updated successfully.';

        }
        if ($request->current_password !== null) {
            // Check current password
            if (! Hash::check($request->current_password, $user->password)) {
                return Redirect::back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $updatedAttributes['password'] = Hash::make($request->password);
            $returnMessage = $returnMessage.' and password updated successfully.';
        }
        $user->update($updatedAttributes);

        return Redirect::back()->with('success', $returnMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->id !== Auth::user()->id) {
            return Redirect::back()->with('error', 'Not logged in. cannot delete user.');
        }
        // Delete the image file if it exists
        if (Storage::exists($user->logo)) {
            Storage::delete($user->logo);
        }

        $user->delete();
        Auth::logout();

        // Redirect to home page
        return Redirect::route('home')->with('success', 'User deleted successfully.');
    }
}
