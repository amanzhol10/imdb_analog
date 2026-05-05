<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Actor;
use App\Models\Genre;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title'       => 'Inception',
                'description' => 'A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'year'        => 2010,
                'director'    => 'Christopher Nolan',
                'genres'      => ['Sci-Fi', 'Thriller', 'Action'],
                'actors'      => [
                    ['name' => 'Leonardo DiCaprio', 'character' => 'Dom Cobb'],
                ],
            ],
            [
                'title'       => 'The Dark Knight',
                'description' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'year'        => 2008,
                'director'    => 'Christopher Nolan',
                'genres'      => ['Action', 'Crime', 'Drama'],
                'actors'      => [
                    ['name' => 'Robert Downey Jr.', 'character' => 'Harvey Dent (cameo)'],
                ],
            ],
            [
                'title'       => 'Forrest Gump',
                'description' => 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective of an Alabama man with an IQ of 75.',
                'year'        => 1994,
                'director'    => 'Robert Zemeckis',
                'genres'      => ['Drama', 'Romance', 'Comedy'],
                'actors'      => [
                    ['name' => 'Tom Hanks', 'character' => 'Forrest Gump'],
                ],
            ],
            [
                'title'       => 'Black Swan',
                'description' => 'A committed dancer wins the lead role in a production of Tchaikovsky\'s Swan Lake only to find herself struggling to maintain her sanity.',
                'year'        => 2010,
                'director'    => 'Darren Aronofsky',
                'genres'      => ['Drama', 'Thriller', 'Horror'],
                'actors'      => [
                    ['name' => 'Natalie Portman', 'character' => 'Nina Sayers'],
                ],
            ],
            [
                'title'       => 'Fight Club',
                'description' => 'An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more.',
                'year'        => 1999,
                'director'    => 'David Fincher',
                'genres'      => ['Drama', 'Thriller', 'Crime'],
                'actors'      => [
                    ['name' => 'Brad Pitt', 'character' => 'Tyler Durden'],
                ],
            ],
            [
                'title'       => 'Iron Man',
                'description' => 'After being held captive in an Afghan cave, billionaire engineer Tony Stark creates a unique weaponized suit of armor to fight evil.',
                'year'        => 2008,
                'director'    => 'Jon Favreau',
                'genres'      => ['Action', 'Sci-Fi'],
                'actors'      => [
                    ['name' => 'Robert Downey Jr.', 'character' => 'Tony Stark / Iron Man'],
                    ['name' => 'Scarlett Johansson', 'character' => 'Natasha Romanoff'],
                ],
            ],
            [
                'title'       => 'La La Land',
                'description' => 'While navigating their careers in Los Angeles, a pianist and an actress fall in love while attempting to reconcile their aspirations for the future.',
                'year'        => 2016,
                'director'    => 'Damien Chazelle',
                'genres'      => ['Romance', 'Drama', 'Comedy'],
                'actors'      => [
                    ['name' => 'Emma Stone', 'character' => 'Mia Dolan'],
                ],
            ],
            [
                'title'       => 'The Wolf of Wall Street',
                'description' => 'Based on the true story of Jordan Belfort, from his rise to a wealthy stockbroker living the high life to his fall involving crime, corruption and the federal government.',
                'year'        => 2013,
                'director'    => 'Martin Scorsese',
                'genres'      => ['Crime', 'Drama', 'Comedy'],
                'actors'      => [
                    ['name' => 'Leonardo DiCaprio', 'character' => 'Jordan Belfort'],
                ],
            ],
            [
                'title'       => 'Avengers: Endgame',
                'description' => 'After the devastating events of Infinity War, the Avengers assemble once more in order to reverse Thanos\'s actions and restore balance to the universe.',
                'year'        => 2019,
                'director'    => 'Anthony & Joe Russo',
                'genres'      => ['Action', 'Sci-Fi', 'Fantasy'],
                'actors'      => [
                    ['name' => 'Robert Downey Jr.', 'character' => 'Tony Stark / Iron Man'],
                    ['name' => 'Scarlett Johansson', 'character' => 'Natasha Romanoff'],
                ],
            ],
            [
                'title'       => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'year'        => 1994,
                'director'    => 'Frank Darabont',
                'genres'      => ['Drama', 'Crime'],
                'actors'      => [
                    ['name' => 'Denzel Washington', 'character' => 'Ellis Boyd "Red" Redding'],
                ],
            ],
            [
                'title'       => 'Interstellar',
                'description' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
                'year'        => 2014,
                'director'    => 'Christopher Nolan',
                'genres'      => ['Sci-Fi', 'Drama', 'Action'],
                'actors'      => [
                    ['name' => 'Cate Blanchett', 'character' => 'Dr. Brand'],
                ],
            ],
            [
                'title'       => 'Pulp Fiction',
                'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits interweave in four tales of violence and redemption.',
                'year'        => 1994,
                'director'    => 'Quentin Tarantino',
                'genres'      => ['Crime', 'Drama', 'Thriller'],
                'actors'      => [
                    ['name' => 'Brad Pitt', 'character' => 'Floyd'],
                ],
            ],
        ];

        foreach ($movies as $data) {
            $movie = Movie::firstOrCreate(
                ['title' => $data['title'], 'year' => $data['year']],
                [
                    'description' => $data['description'],
                    'director'    => $data['director'],
                ]
            );

            // Attach genres
            $genreIds = Genre::whereIn('name', $data['genres'])->pluck('id');
            $movie->genres()->syncWithoutDetaching($genreIds);

            // Attach actors
            foreach ($data['actors'] as $actorData) {
                $actor = Actor::where('name', $actorData['name'])->first();
                if ($actor) {
                    $movie->actors()->syncWithoutDetaching([
                        $actor->id => ['character' => $actorData['character']]
                    ]);
                }
            }
        }
    }
}