<?php

namespace App\Http\Repositories;

use App\Models\Genre;

class GenreRepository extends BaseRepository
{

    public function model(): string
    {
        return Genre::class;
    }
}
