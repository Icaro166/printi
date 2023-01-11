<?php

namespace Database\Seeders;

use App\Exceptions\BusinessException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genreArray = $this->genrePullArray();
        DB::table('genres')->insertOrIgnore($genreArray);
    }

    /**
     * @throws BusinessException
     */
    private function genrePullArray()
    {

        $genres = Http::asJson()->get(config('services.tmdb.listGenre'))
            ->json()['genres'];
        if (!empty($genres)) {
            return $genres;
        } else {
            throw new BusinessException("An exception occurred during api call");
        }
    }
}
