<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Often useful to add HasFactory for seeding/testing

// --- Add these 'use' statements at the top ---
use App\Models\Artist;
use App\Models\Song;
// --- End of 'use' statements to add ---

class Album extends Model
{
    // You can add HasFactory here if you plan to use model factories for testing/seeding
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'artist_id',
        'title',
        'release_year',
        'cover_image_path',
        // Add other columns from your 'albums' migration here
    ];

    // --- Add these methods here ---

    /**
     * Get the artist that owns the album.
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the songs for the album.
     */
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    // --- End of methods to add ---
}