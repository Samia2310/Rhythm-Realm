<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Good practice for seeding/testing

// --- Add these 'use' statements at the top ---
use App\Models\User;
use App\Models\Song;
// --- End of 'use' statements to add ---

class Playlist extends Model
{
    // You can add HasFactory here if you plan to use model factories for testing/seeding
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_public',
        // Add other columns from your 'playlists' migration here
    ];

    // --- Add these methods here ---

    /**
     * Get the user that owns the playlist.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The songs that belong to the playlist.
     */
    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_song'); // 'playlist_song' is the pivot table name
    }

    // --- End of methods to add ---
}