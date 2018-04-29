<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create(['genre'=>'RPG',]);
        Genre::create(['genre'=>'FPS',]);
        Genre::create(['genre'=>'Action',]);
        Genre::create(['genre'=>'Racing',]);
        Genre::create(['genre'=>'Arcade',]);
        Genre::create(['genre'=>'Simulation',]);
        Genre::create(['genre'=>'Sport',]);
    }
}
