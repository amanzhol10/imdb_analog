<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TvSeries;
use App\Models\Actor;
use App\Models\Genre;

class TvSeriesSeeder extends Seeder
{
    public function run(): void
    {
        $seriesList = [
            [
                'title'       => 'Breaking Bad',
                'description' => 'A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine to secure his family\'s future.',
                'year'        => 2008,
                'director'    => 'Vince Gilligan',
                'seasons'     => 5,
                'status'      => 'ended',
                'genres'      => ['Crime', 'Drama', 'Thriller'],
                'actors'      => [
                    ['name' => 'Bryan Cranston', 'character' => 'Walter White'],
                    ['name' => 'Anna Gunn',      'character' => 'Skyler White'],
                ],
            ],
            [
                'title'       => 'Game of Thrones',
                'description' => 'Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.',
                'year'        => 2011,
                'director'    => 'David Benioff, D.B. Weiss',
                'seasons'     => 8,
                'status'      => 'ended',
                'genres'      => ['Fantasy', 'Drama', 'Action'],
                'actors'      => [
                    ['name' => 'Emilia Clarke', 'character' => 'Daenerys Targaryen'],
                    ['name' => 'Kit Harington', 'character' => 'Jon Snow'],
                ],
            ],
            [
                'title'       => 'Stranger Things',
                'description' => 'When a young boy disappears, his mother, a police chief and his friends must confront terrifying supernatural forces in order to get him back.',
                'year'        => 2016,
                'director'    => 'The Duffer Brothers',
                'seasons'     => 4,
                'status'      => 'ongoing',
                'genres'      => ['Sci-Fi', 'Horror', 'Drama'],
                'actors'      => [
                    ['name' => 'Cate Blanchett', 'character' => 'Guest Villain'],
                ],
            ],
            [
                'title'       => 'The Witcher',
                'description' => 'Geralt of Rivia, a solitary monster hunter, struggles to find his place in a world where people often prove more wicked than beasts.',
                'year'        => 2019,
                'director'    => 'Lauren Schmidt Hissrich',
                'seasons'     => 3,
                'status'      => 'ongoing',
                'genres'      => ['Fantasy', 'Action', 'Drama'],
                'actors'      => [
                    ['name' => 'Jon Bernthal', 'character' => 'Renfri\'s Guard'],
                ],
            ],
            [
                'title'       => 'The Crown',
                'description' => 'Follows the political rivalries and romance of Queen Elizabeth II\'s reign and the events that shaped the second half of the 20th century.',
                'year'        => 2016,
                'director'    => 'Peter Morgan',
                'seasons'     => 6,
                'status'      => 'ended',
                'genres'      => ['Drama', 'Romance'],
                'actors'      => [
                    ['name' => 'Meryl Streep', 'character' => 'Guest Narrator'],
                ],
            ],
            [
                'title'       => 'Severance',
                'description' => 'Mark leads a team of office workers whose memories have been surgically divided between their work and personal lives.',
                'year'        => 2022,
                'director'    => 'Dan Erickson',
                'seasons'     => 2,
                'status'      => 'ongoing',
                'genres'      => ['Sci-Fi', 'Thriller', 'Drama'],
                'actors'      => [
                    ['name' => 'Natalie Portman', 'character' => 'Cobel (alt)'],
                ],
            ],
            [
                'title'       => 'The Bear',
                'description' => 'A young chef from the fine dining world comes to run a beef sandwich shop in Chicago, learning to manage a difficult kitchen.',
                'year'        => 2022,
                'director'    => 'Christopher Storer',
                'seasons'     => 3,
                'status'      => 'ongoing',
                'genres'      => ['Drama', 'Comedy'],
                'actors'      => [
                    ['name' => 'Jon Bernthal', 'character' => 'Mikey Berzatto'],
                ],
            ],
            [
                'title'       => 'Black Mirror',
                'description' => 'An anthology series exploring a twisted, high-tech multiverse where humanity\'s greatest innovations and darkest instincts collide.',
                'year'        => 2011,
                'director'    => 'Charlie Brooker',
                'seasons'     => 6,
                'status'      => 'ongoing',
                'genres'      => ['Sci-Fi', 'Thriller', 'Horror'],
                'actors'      => [
                    ['name' => 'Scarlett Johansson', 'character' => 'AI Voice (ep. 3)'],
                ],
            ],
        ];

        foreach ($seriesList as $data) {
            $series = TvSeries::firstOrCreate(
                ['title' => $data['title'], 'year' => $data['year']],
                [
                    'description' => $data['description'],
                    'director'    => $data['director'],
                    'seasons'     => $data['seasons'],
                    'status'      => $data['status'],
                ]
            );

            $genreIds = Genre::whereIn('name', $data['genres'])->pluck('id');
            $series->genres()->syncWithoutDetaching($genreIds);

            foreach ($data['actors'] as $actorData) {
                $actor = Actor::where('name', $actorData['name'])->first();
                if ($actor) {
                    $series->actors()->syncWithoutDetaching([
                        $actor->id => ['character' => $actorData['character']]
                    ]);
                }
            }
        }
    }
}