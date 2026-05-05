<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorSeeder extends Seeder
{
    public function run(): void
    {
        $actors = [
            ['name' => 'Leonardo DiCaprio', 'birth_date' => '1974-11-11', 'bio' => 'American actor and film producer known for his work in biopics and period films.'],
            ['name' => 'Scarlett Johansson', 'birth_date' => '1984-11-22', 'bio' => 'American actress known for her roles in action and drama films.'],
            ['name' => 'Tom Hanks',          'birth_date' => '1956-07-09', 'bio' => 'Legendary American actor known for heartwarming and dramatic roles.'],
            ['name' => 'Natalie Portman',    'birth_date' => '1981-06-09', 'bio' => 'Israeli-American actress and filmmaker.'],
            ['name' => 'Brad Pitt',          'birth_date' => '1963-12-18', 'bio' => 'American actor and film producer known for diverse roles.'],
            ['name' => 'Cate Blanchett',     'birth_date' => '1969-05-14', 'bio' => 'Australian actress regarded as one of the finest of her generation.'],
            ['name' => 'Robert Downey Jr.',  'birth_date' => '1965-04-04', 'bio' => 'American actor best known for portraying Iron Man in the MCU.'],
            ['name' => 'Meryl Streep',       'birth_date' => '1949-06-22', 'bio' => 'American actress often described as the best actress of her generation.'],
            ['name' => 'Denzel Washington',  'birth_date' => '1954-12-28', 'bio' => 'American actor and filmmaker known for powerful dramatic performances.'],
            ['name' => 'Emma Stone',         'birth_date' => '1988-11-06', 'bio' => 'American actress known for her roles in La La Land and Easy A.'],
            ['name' => 'Bryan Cranston',     'birth_date' => '1956-03-07', 'bio' => 'American actor famous for his role as Walter White in Breaking Bad.'],
            ['name' => 'Emilia Clarke',      'birth_date' => '1986-10-23', 'bio' => 'British actress known for her role as Daenerys in Game of Thrones.'],
            ['name' => 'Jon Bernthal',       'birth_date' => '1976-09-20', 'bio' => 'American actor known for The Walking Dead and The Punisher.'],
            ['name' => 'Anna Gunn',          'birth_date' => '1968-08-11', 'bio' => 'American actress known for playing Skyler White in Breaking Bad.'],
            ['name' => 'Kit Harington',      'birth_date' => '1986-12-26', 'bio' => 'British actor known for portraying Jon Snow in Game of Thrones.'],
        ];

        foreach ($actors as $actor) {
            Actor::firstOrCreate(['name' => $actor['name']], $actor);
        }
    }
}