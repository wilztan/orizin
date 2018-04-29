<?php

use Illuminate\Database\Seeder;
use App\Game;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::create([
            'name' => 'BattleField',
            'price' => '200000',
            'release' => '2010-09-21',
            'picture' => 'jpg',
            'genre_id'=>'2',
        ]);

        Game::create([
            'name' => 'Final Fantasy',
            'price' => '250000',
            'release' => '2010-09-22',
            'picture' => 'jpg',
            'genre_id'=>'1',
        ]);

        Game::create([
            'name' => 'Call Of Duty',
            'price' => '190000',
            'release' => '2011-10-21',
            'picture' => 'jpg',
            'genre_id'=>'2',
        ]);

        
    }
}
