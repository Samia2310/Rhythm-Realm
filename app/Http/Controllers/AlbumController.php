<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist; // Needed for the artist selection in create/edit forms
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; // Add this line to correctly import the base Controller

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load albums with their associated artist to display artist name.
        $albums = Album::with('artist')->orderBy('title')->paginate(10);
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all artists to populate the dropdown in the album creation form.
        $artists = Artist::orderBy('name')->get();
        return view('albums.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id', // Ensure selected artist exists
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'cover_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image_path')) {
            $imagePath = $request->file('cover_image_path')->store('public/album_covers');
            $validatedData['cover_image_path'] = str_replace('public/', '', $imagePath);
        }

        Album::create($validatedData);

        return redirect()->route('albums.index')->with('success', 'Album created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        // Load the artist and songs relationships for the album
        $album->load('artist', 'songs');
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        // Fetch all artists for the dropdown in the edit form.
        $artists = Artist::orderBy('name')->get();
        return view('albums.edit', compact('album', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'cover_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image_path')) {
            if ($album->cover_image_path) {
                Storage::delete('public/' . $album->cover_image_path);
            }
            $imagePath = $request->file('cover_image_path')->store('public/album_covers');
            $validatedData['cover_image_path'] = str_replace('public/', '', $imagePath);
        }

        $album->update($validatedData);

        return redirect()->route('albums.show', $album->id)->with('success', 'Album updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        // Delete associated cover image
        if ($album->cover_image_path) {
            Storage::delete('public/' . $album->cover_image_path);
        }

        // Eloquent will automatically handle deleting associated songs due to 'onDelete('cascade')' in migration
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully!');
    }
}
