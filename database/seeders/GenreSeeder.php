<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Фантастика',
            'Детектив',
            'Роман',
            'Научная литература',
            'Биография',
            'Исторический',
            'Ужасы',
            'Приключения',
            'Фэнтези',
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
