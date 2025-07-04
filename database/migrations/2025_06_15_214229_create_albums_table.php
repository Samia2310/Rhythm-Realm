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
    Schema::create('albums', function (Blueprint $table) {
        $table->id();
        $table->foreignId('artist_id')->constrained()->onDelete('cascade'); // Link to Artist
        $table->string('title');
        $table->year('release_year')->nullable();
        $table->string('cover_image_path')->nullable(); // For album cover
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
