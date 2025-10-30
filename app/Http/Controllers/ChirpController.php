<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chirps = Chirp::orderBy('id', 'DESC')->get();
        return view('welcome', compact('chirps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => Auth::user()->id]);
        $chripAtrributes = $request->validate([
            'user_id' => ['required'],
            'message' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,gif', 'max:2048'],
        ]);

        $imagePath = null;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Create images directory if it doesn't exist
            $destinationPath = public_path('images/chirps');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate unique filename
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Move file to public/images directory
            $image->move($destinationPath, $imageName);

            // Store relative path for database
            $imagePath = 'images/chirps/' . $imageName;
            // Update image in attributes
            $chripAtrributes['image'] = $imagePath;
        }

        Chirp::create($chripAtrributes);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
