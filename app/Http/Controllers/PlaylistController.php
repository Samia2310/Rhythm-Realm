<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song; // Needed for adding songs to playlists
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // To get the currently authenticated user

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     * Shows playlists belonging to the authenticated user.
     */
    public function index()
    {
        // Get playlists for the authenticated user, ordered by name.
        $playlists = Auth::user()->playlists()->orderBy('name')->paginate(10);
        return view('playlists.index', compact('playlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('playlists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean', // Checkbox sends 0 or 1, or not present if unchecked.
        ]);

        // Add the authenticated user's ID to the data.
        $validatedData['user_id'] = Auth::id();

        // If 'is_public' checkbox is not checked, it won't be in the request.
        // Ensure it's set to false in that case.
        $validatedData['is_public'] = $request->has('is_public');

        Playlist::create($validatedData);

        return redirect()->route('playlists.index')->with('success', 'Playlist created successfully!');
    }

    /**
     * Display the specified resource.
     * Shows a playlist and its songs. Only public playlists or user's own playlists are accessible.
     */
    public function show(Playlist $playlist)
    {
        // Load the user and songs relationships.
        $playlist->load('user', 'songs.artist', 'songs.album'); // Load artist and album with songs for display

        // Authorization check: Only show public playlists or playlists owned by the current user.
        if (!$playlist->is_public && Auth::id() !== $playlist->user_id) {
            abort(403, 'Unauthorized action.'); // Or redirect to a different page
        }

        // For the 'Add Song' dropdown, fetch all available songs.
        // In a real app, you might want to paginate/search this or load dynamically.
        $allSongs = Song::with('artist')->orderBy('title')->get();

        return view('playlists.show', compact('playlist', 'allSongs'));
    }

    /**
     * Show the form for editing the specified resource.
     * Only the playlist owner can edit.
     */
    public function edit(Playlist $playlist)
    {
        // Authorization check: Only the owner can edit.
        if (Auth::id() !== $playlist->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('playlists.edit', compact('playlist'));
    }

    /**
     * Update the specified resource in storage.
     * Only the playlist owner can update.
     */
    public function update(Request $request, Playlist $playlist)
    {
        // Authorization check: Only the owner can update.
        if (Auth::id() !== $playlist->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);

        $validatedData['is_public'] = $request->has('is_public');

        $playlist->update($validatedData);

        return redirect()->route('playlists.show', $playlist->id)->with('success', 'Playlist updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * Only the playlist owner can delete.
     */
    public function destroy(Playlist $playlist)
    {
        // Authorization check: Only the owner can delete.
        if (Auth::id() !== $playlist->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $playlist->delete(); // Eloquent handles detaching pivot table records automatically.

        return redirect()->route('playlists.index')->with('success', 'Playlist deleted successfully!');
    }

    /**
     * Attach a song to a playlist.
     * Only the playlist owner can add songs.
     */
    public function addSong(Request $request, Playlist $playlist)
    {
        // Authorization check: Only the owner can add songs.
        if (Auth::id() !== $playlist->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'song_id' => 'required|exists:songs,id', // Ensure the song exists
        ]);

        // Prevent adding duplicate songs to the same playlist.
        if (!$playlist->songs()->where('song_id', $request->song_id)->exists()) {
            $playlist->songs()->attach($request->song_id);
            return back()->with('success', 'Song added to playlist successfully!');
        }

        return back()->with('error', 'Song is already in this playlist.');
    }

    /**
     * Detach a song from a playlist.
     * Only the playlist owner can remove songs.
     */
    public function removeSong(Playlist $playlist, Song $song)
    {
        // Authorization check: Only the owner can remove songs.
        if (Auth::id() !== $playlist->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $playlist->songs()->detach($song->id);
        return back()->with('success', 'Song removed from playlist successfully!');
    }
}
