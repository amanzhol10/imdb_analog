<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            ActorSeeder::class,
            MovieSeeder::class,
            TvSeriesSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}