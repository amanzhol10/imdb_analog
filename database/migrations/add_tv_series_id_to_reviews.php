<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('tv_series_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->nullable()->change();
        });
    }
    public function down(): void {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['tv_series_id']);
            $table->dropColumn('tv_series_id');
        });
    }
};