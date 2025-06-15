<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Often useful to add HasFactory for seeding/testing

// --- Add these 'use' statements at the top ---
use App\Models\Album;
use App\Models\Song;
// --- End of 'use' statements to add ---

class Artist extends Model
{
    // You can add HasFactory here if you plan to use model factories for testing/seeding
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'bio',
        'genre',
        'image_path',
        // Add other columns from your 'artists' migration here
    ];

    // --- Add these methods here ---

    /**
     * Get the albums for the artist.
     */
    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    /**
     * Get the songs for the artist.
     */
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    // --- End of methods to add ---
}