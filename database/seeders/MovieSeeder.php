<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            ['title' => 'Фильм 1', 'is_published' => true, 'poster' => 'default.jpg'],
            ['title' => 'Фильм 2', 'is_published' => false, 'poster' => 'default.jpg']
        ];

        foreach ($movies as $data) {
            $movie = Movie::create($data);
            $movie->genres()->attach(Genre::inRandomOrder()->take(2)->pluck('id'));
        }
    }
}
