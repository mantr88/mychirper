<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chirp;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chirps = Chirp::with('user')->latest()->take(50)->get();
        return view('home', ['chirps' => $chirps]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Validate the request
     $validated = $request->validate([
        'message' => 'required|string|max:255',
    ], [
        'message.required' => 'Please write something to chirp!',
        'message.max' => 'Chirps must be 255 characters or less.',
    ]);
 
    // Create the chirp (no user for now - we'll add auth later)
    Chirp::create([
        'message' => $validated['message'],
        'user_id' => null, // We'll add authentication in lesson 11
    ]);
 
    // Redirect back to the feed
    return redirect('/')->with('success', 'Chirp created!');
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
    public function edit(Chirp $chirp)
    {
         return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
    // Validate
    $validated = $request->validate([
        'message' => 'required|string|max:255',
    ]);
 
    // Update
    $chirp->update($validated);
 
    return redirect('/')->with('success', 'Chirp updated!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
{
    $chirp->delete();
 
    return redirect('/')->with('success', 'Chirp deleted!');
}
}
