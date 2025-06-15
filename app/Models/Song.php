<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Good practice for seeding/testing

// --- Add these 'use' statements at the top ---
use App\Models\Artist;
use App\Models\Album;
use App\Models\Playlist;
// --- End of 'use' statements to add ---

class Song extends Model
{
    // You can add HasFactory here if you plan to use model factories for testing/seeding
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'artist_id',
        'album_id',
        'title',
        'file_path',
        'duration_seconds',
        'play_count',
        // Add other columns from your 'songs' migration here
    ];

    // --- Add these methods here ---

    /**
     * Get the artist that owns the song.
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the album that the song belongs to (if any).
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * The playlists that belong to the song.
     */
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_song'); // 'playlist_song' is the pivot table name
    }

    // --- End of methods to add ---
}