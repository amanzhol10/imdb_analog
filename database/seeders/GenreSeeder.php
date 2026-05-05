<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Action',      'slug' => 'action',      'description' => 'High-energy films with stunts and battles'],
            ['name' => 'Drama',       'slug' => 'drama',       'description' => 'Emotional and character-driven stories'],
            ['name' => 'Comedy',      'slug' => 'comedy',      'description' => 'Lighthearted and humorous content'],
            ['name' => 'Thriller',    'slug' => 'thriller',    'description' => 'Suspenseful and tension-filled stories'],
            ['name' => 'Sci-Fi',      'slug' => 'sci-fi',      'description' => 'Science fiction and futuristic worlds'],
            ['name' => 'Horror',      'slug' => 'horror',      'description' => 'Frightening and scary content'],
            ['name' => 'Romance',     'slug' => 'romance',     'description' => 'Love stories and relationships'],
            ['name' => 'Crime',       'slug' => 'crime',       'description' => 'Crime and detective stories'],
            ['name' => 'Fantasy',     'slug' => 'fantasy',     'description' => 'Magical and mythical worlds'],
            ['name' => 'Animation',   'slug' => 'animation',   'description' => 'Animated films and series'],
        ];

        foreach ($genres as $genre) {
            Genre::firstOrCreate(['slug' => $genre['slug']], $genre);
        }
    }
}