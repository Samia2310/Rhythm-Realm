<?php

namespace App\Http\Controllers;

use App\Models\Artist; // Import your Artist Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // For handling file uploads (images)

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     * Fetches all artists from the database, paginates them, and passes them to the index view.
     */
    public function index()
    {
        // Retrieve all artists, ordered by name, with pagination for better performance on large datasets.
        // The paginate(10) means 10 artists per page.
        $artists = Artist::orderBy('name')->paginate(10);

        // Return the 'artists.index' Blade view and make the '$artists' data available to it.
        return view('artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     * Displays the form where a user can input details for a new artist.
     */
    public function create()
    {
        // Simply returns the view containing the form for creating a new artist.
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     * Handles the form submission from the 'create' view, validates data,
     * stores the artist's profile picture (if uploaded), and saves the artist to the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data based on your form fields and database schema.
        // 'required' means the field cannot be empty.
        // 'string' ensures it's a string.
        // 'max:255' sets maximum length.
        // 'unique:artists,name' ensures the artist name is unique in the 'artists' table.
        // 'nullable' means the field is optional.
        // 'image|mimes:...' validates it's an image of allowed types.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:artists,name',
            'bio' => 'nullable|string',
            'genre' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB file size
        ]);

        // Check if an image file was uploaded with the request.
        if ($request->hasFile('image_path')) {
            // Store the uploaded image in the 'storage/app/public/artists_images' directory.
            // The 'store' method returns the path relative to 'storage/app/'.
            $imagePath = $request->file('image_path')->store('public/artists_images');

            // We store the path without the 'public/' prefix in the database,
            // as Storage::url() will automatically add it when retrieving.
            $validatedData['image_path'] = str_replace('public/', '', $imagePath);
        }

        // Create a new Artist record in the database using the validated data.
        // Laravel's Eloquent ORM will automatically handle saving to the 'artists' table.
        Artist::create($validatedData);

        // Redirect the user back to the artists listing page,
        // and attach a success message to the session for display.
        return redirect()->route('artists.index')->with('success', 'Artist created successfully!');
    }

    /**
     * Display the specified resource.
     * Shows detailed information about a single artist.
     * Laravel's Route Model Binding (Artist $artist) automatically finds the artist
     * based on the ID in the URL.
     */
    public function show(Artist $artist)
    {
        // Pass the found artist object to the 'artists.show' view.
        return view('artists.show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     * Displays the pre-filled form for updating an existing artist's details.
     */
    public function edit(Artist $artist)
    {
        // Pass the found artist object to the 'artists.edit' view.
        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     * Handles the form submission from the 'edit' view, validates data,
     * updates the artist's profile picture (deleting old one if replaced),
     * and updates the artist record in the database.
     */
    public function update(Request $request, Artist $artist)
    {
        // Validate the incoming request data.
        // The 'unique:artists,name,' . $artist->id part ensures that if the name
        // doesn't change, or changes to another existing name, it's still unique
        // but allows the current artist's name to be re-used.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:artists,name,' . $artist->id,
            'bio' => 'nullable|string',
            'genre' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload for a new image.
        if ($request->hasFile('image_path')) {
            // If the artist already has an old image, delete it from storage
            // to prevent orphaned files.
            if ($artist->image_path) {
                Storage::delete('public/' . $artist->image_path);
            }
            // Store the new image.
            $imagePath = $request->file('image_path')->store('public/artists_images');
            $validatedData['image_path'] = str_replace('public/', '', $imagePath);
        }

        // Update the existing Artist record with the validated data.
        $artist->update($validatedData);

        // Redirect back to the specific artist's show page with a success message.
        return redirect()->route('artists.show', $artist->id)->with('success', 'Artist updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * Deletes an artist record and its associated profile picture from storage.
     */
    public function destroy(Artist $artist)
    {
        // If the artist has an associated image, delete it from storage.
        if ($artist->image_path) {
            Storage::delete('public/' . $artist->image_path);
        }

        // Delete the artist record from the database.
        $artist->delete();

        // Redirect back to the artists index page with a success message.
        return redirect()->route('artists.index')->with('success', 'Artist deleted successfully!');
    }
}
