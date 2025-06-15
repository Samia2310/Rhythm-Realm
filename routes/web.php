<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('artists', ArtistController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('songs', SongController::class);
    Route::resource('playlists', PlaylistController::class);
    Route::post('playlists/{playlist}/add-song', [PlaylistController::class, 'addSong'])->name('playlists.add_song');
    Route::delete('playlists/{playlist}/remove-song/{song}', [PlaylistController::class, 'removeSong'])->name('playlists.remove_song');
});

require __DIR__.'/auth.php';
