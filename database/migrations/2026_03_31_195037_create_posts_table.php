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
    Schema::create('posts', function (Blueprint $table) {
        $table->id(); // Автоматический ID для каждого поста
        $table->string('title')->unique(); // Заголовок поста (не может повторяться)
        $table->text('body'); // Основной текст поста
        $table->string('author')->nullable(); // Имя автора (может быть пустым)
        $table->timestamps(); // Колонки created_at и updated_at (время создания и обновления)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
