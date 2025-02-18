<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = ['Комедия', 'Драма', 'Боевик', 'Мелодрама', 'Фантастика', 'Хоррор'];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
