<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Artist; // Needed for artist selection
use App\Models\Album;  // Needed for album selection
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load songs with their associated artist and album for display.
        $songs = Song::with('artist', 'album')->orderBy('title')->paginate(10);
        return view('songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch artists and albums to populate dropdowns.
        $artists = Artist::orderBy('name')->get();
        $albums = Album::with('artist')->orderBy('title')->get(); // Load artist with album for better display
        return view('songs.create', compact('artists', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'file_path' => 'required|file|mimes:mp3,wav|max:51200', // Max 50MB audio file
            'duration_seconds' => 'required|integer|min:0', // Manual duration for now
            'lyrics' => 'nullable|string',
        ]);

        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('public/audio_files');
            $validatedData['file_path'] = str_replace('public/', '', $filePath);
        }

        Song::create($validatedData);

        return redirect()->route('songs.index')->with('success', 'Song created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        // Increment play count (simple implementation)
        $song->increment('play_count');
        // Load artist and album relationships for display.
        $song->load('artist', 'album');
        return view('songs.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        // Fetch artists and albums for dropdowns in the edit form.
        $artists = Artist::orderBy('name')->get();
        $albums = Album::with('artist')->orderBy('title')->get();
        return view('songs.edit', compact('song', 'artists', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'file_path' => 'nullable|file|mimes:mp3,wav|max:51200',
            'duration_seconds' => 'required|integer|min:0',
            'lyrics' => 'nullable|string',
        ]);

        if ($request->hasFile('file_path')) {
            // Delete old audio file if it exists
            if ($song->file_path) {
                Storage::delete('public/' . $song->file_path);
            }
            $filePath = $request->file('file_path')->store('public/audio_files');
            $validatedData['file_path'] = str_replace('public/', '', $filePath);
        }

        $song->update($validatedData);

        return redirect()->route('songs.show', $song->id)->with('success', 'Song updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        // Delete associated audio file
        if ($song->file_path) {
            Storage::delete('public/' . $song->file_path);
        }

        $song->delete();

        return redirect()->route('songs.index')->with('success', 'Song deleted successfully!');
    }
}
