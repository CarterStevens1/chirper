<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,gif', 'max:2048'],
            'name' => ['required'],
            'email' =>  ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],

        ]);
        $imagePath = null;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Create images directory if it doesn't exist
            $destinationPath = public_path('images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique filename
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Move file to public/images directory
            $image->move($destinationPath, $imageName);

            // Store relative path for database
            $imagePath = 'images/' . $imageName;
            // Update image in attributes
            $userAtrributes['image'] = $imageName;
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
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,gif', 'max:2048'],
            'name' => ['required'],
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return Redirect::back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($request->image_path && file_exists(public_path($request->image_path))) {
                unlink(public_path($request->image_path));
            }

            $image = $request->file('image');

            // Create images directory if it doesn't exist
            $destinationPath = public_path('images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique filename
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Move file to public/images directory
            $image->move($destinationPath, $imageName);

            // Update the image path
            $request->image_path = 'images/' . $imageName;
        }

        return Redirect::back()->with('success', 'Password updated successfully.');
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
        if ($user->image && file_exists(public_path('images/' . $user->image))) {
            unlink(public_path('images/' . $user->image));
        }
        $user->delete();
        Auth::logout();
        // Redirect to home page
        return Redirect::route('home')->with('success', 'User deleted successfully.');
    }
}
