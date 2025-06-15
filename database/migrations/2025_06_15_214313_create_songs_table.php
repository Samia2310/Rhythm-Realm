<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('songs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('artist_id')->constrained()->onDelete('cascade'); // Link to Artist
        $table->foreignId('album_id')->nullable()->constrained()->onDelete('set null'); // Optional link to Album
        $table->string('title');
        $table->string('file_path'); // Path to the audio file
        $table->integer('duration_seconds')->nullable(); // Duration in seconds
        $table->integer('play_count')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
