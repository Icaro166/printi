<?php

namespace Tests\Unit;

use App\Http\Services\TheMovieAPIService;
use PHPUnit\Framework\TestCase;

class TmdbApiUnitTest extends TestCase
{

    public string $title;

    /**
     * A basic unit test example.
     *
     * @param $title
     * @return void
     */
    public function test_replace_title_movie_sucess()
    {
        $theMovieAPIService = new TheMovieAPIService();
        $this->title = 'Laranja Mecanica';
        $replaceResult = $theMovieAPIService->replace($this);
        $this->assertEquals('Laranja+Mecanica', $replaceResult);
    }
    public function  test_convert_tmdb_result_array_in_movie_success()
    {
        $theMovieAPIService = new TheMovieAPIService();
        $tmdb = $this->makeTmdb();
        $tmdbExpected = $this->makeExpectTmdb();
        $tmdbResult = $theMovieAPIService->convertTMDBResultArrayInMovie($tmdb);
        $this->assertEquals($tmdbExpected, $tmdbResult);
    }

    public function makeTmdb(){
        return ['page'=>1,'results'=>[[
            'title' => 'Laranja Mecanica',
            'release_date' => '1971-04-26',
            'overview' => 'O jovem Alex passa as noites com uma gangue de amigos briguentos.',
            'id' => '21',
            'genre_ids' =>[1],
            'popularity'=>3.4,
        ]
        ],
            'total_pages'=>1
        ];
    }
    public function makeExpectTmdb(){
        return ['page'=>1,'result'=>[[
            'title' => 'Laranja Mecanica',
            'release_date' => '1971-04-26',
            'overview' => 'O jovem Alex passa as noites com uma gangue de amigos briguentos.',
            'tmdb_id' => '21',
            'genre_ids' =>[1],

        ]],
            'total_pages'=>1
        ];
    }
}
