<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('bio')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });

        Schema::create('actor_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actor_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->string('character')->nullable();
        });

        Schema::create('actor_tv_series', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actor_id')->constrained()->onDelete('cascade');
            $table->foreignId('tv_series_id')->constrained()->onDelete('cascade');
            $table->string('character')->nullable();
        });
    }
    public function down(): void {
        Schema::dropIfExists('actor_tv_series');
        Schema::dropIfExists('actor_movie');
        Schema::dropIfExists('actors');
    }
};