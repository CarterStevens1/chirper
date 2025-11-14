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
        $chirps = Chirp::latest()->with('user:id,logo,name')->get();

        return view('welcome', ['chirps' => $chirps]);
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

        $chripAtrributes['message'] = preg_replace('/(\r\n|\n|\r){2,}/', "\n", $chripAtrributes['message']);

        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('chirp-images');
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
