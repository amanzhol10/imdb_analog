<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Movie;
use App\Models\TvSeries;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        if ($users->isEmpty()) {
            $this->command->warn('No users found. Skipping reviews.');
            return;
        }

        $movieReviews = [
            'Inception'                  => [[8, 'Mind-blowing concept and execution. Nolan at his best.'], [9, 'One of the greatest films ever made.'], [7, 'Great but confusing on first watch.']],
            'The Dark Knight'            => [[10, 'Heath Ledger\'s Joker is iconic. Perfect superhero film.'], [9, 'Redefines the genre completely.'], [8, 'Brilliant storytelling and performances.']],
            'Forrest Gump'               => [[10, 'An emotional masterpiece. Tom Hanks is phenomenal.'], [9, 'Makes you laugh and cry in the same scene.']],
            'Fight Club'                 => [[9, 'A cult classic. The twist is unforgettable.'], [8, 'Dark, twisted, and absolutely brilliant.']],
            'Iron Man'                   => [[8, 'Robert Downey Jr. was born to play this role.'], [7, 'Fun blockbuster that launched the MCU.']],
            'La La Land'                 => [[9, 'Beautiful, bittersweet, and perfectly crafted.'], [8, 'Emma Stone is radiant.']],
            'The Wolf of Wall Street'    => [[8, 'DiCaprio at his most charismatic.'], [7, 'Long but entertaining throughout.']],
            'Avengers: Endgame'          => [[9, 'A satisfying conclusion to 10 years of storytelling.'], [10, 'Epic on every level.']],
            'The Shawshank Redemption'   => [[10, 'The greatest film ever made. Period.'], [10, 'Hope is a good thing.']],
            'Interstellar'               => [[9, 'Visually stunning and emotionally powerful.'], [8, 'Science and emotion combined beautifully.']],
            'Pulp Fiction'               => [[9, 'Tarantino\'s masterwork. Every scene is iconic.'], [8, 'Non-linear storytelling at its finest.']],
            'Black Swan'                 => [[8, 'Haunting and mesmerizing. Portman deserved her Oscar.'], [7, 'Disturbing but brilliant.']],
        ];

        $seriesReviews = [
            'Breaking Bad'    => [[10, 'The greatest TV show ever made. Walter White\'s transformation is incredible.'], [10, 'Perfect from start to finish.'], [9, 'Bryan Cranston gives an all-time performance.']],
            'Game of Thrones' => [[9, 'Early seasons are some of the best television ever.'], [7, 'Later seasons disappoint, but the journey was worth it.']],
            'Stranger Things' => [[8, 'Pure nostalgia with great characters.'], [8, 'Season 4 is the best yet.']],
            'The Witcher'     => [[7, 'Henry Cavill is perfect as Geralt.'], [8, 'Great fantasy world-building.']],
            'Severance'       => [[10, 'The most original concept on TV in years.'], [9, 'Adam Scott is phenomenal.']],
            'The Bear'        => [[9, 'Stressful and brilliant in equal measure.'], [9, 'The "Review" episode is one of TV\'s best.']],
            'Black Mirror'    => [[8, 'Terrifyingly prescient about technology.'], [7, 'Hit and miss but always thought-provoking.']],
            'The Crown'       => [[8, 'Lavish production and great performances.'], [7, 'Fascinating look at the monarchy.']],
        ];

        foreach ($movieReviews as $title => $reviews) {
            $movie = Movie::where('title', $title)->first();
            if (!$movie) continue;
            foreach ($reviews as $i => [$rating, $content]) {
                $user = $users[$i % $users->count()];
                Review::firstOrCreate(
                    ['movie_id' => $movie->id, 'user_id' => $user->id],
                    ['rating' => $rating, 'content' => $content]
                );
            }
        }

        foreach ($seriesReviews as $title => $reviews) {
            $series = TvSeries::where('title', $title)->first();
            if (!$series) continue;
            foreach ($reviews as $i => [$rating, $content]) {
                $user = $users[$i % $users->count()];
                Review::firstOrCreate(
                    ['tv_series_id' => $series->id, 'user_id' => $user->id],
                    ['rating' => $rating, 'content' => $content]
                );
            }
        }
    }
}