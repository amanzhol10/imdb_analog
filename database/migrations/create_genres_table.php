<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('genre_movie', function (Blueprint $table) {
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->primary(['genre_id', 'movie_id']);
        });

        Schema::create('genre_tv_series', function (Blueprint $table) {
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->foreignId('tv_series_id')->constrained()->onDelete('cascade');
            $table->primary(['genre_id', 'tv_series_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('genre_tv_series');
        Schema::dropIfExists('genre_movie');
        Schema::dropIfExists('genres');
    }
};