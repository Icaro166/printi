<?php

namespace Tests\Feature\route\api\movie;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;


    public function test_the_application_returns_a_fail_response_in_create()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/movie', ['title' => 'Titanic']);
        $response->assertStatus(422);
    }

    public function test_the_application_returns_a_fail_response_in_find()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/movie');
        $response->assertStatus(404);
    }

    public function test_the_application_returns_a_fail_response_in_findById()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/movie/1');
        $response->assertStatus(404);
    }

    public function test_the_application_returns_a_fail_response_in_update()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/movie/1', ['title' => 'Titanic', 'genre_ids' => [16]]);
        $response->assertStatus(422);
    }

    public function test_the_application_returns_a_success_response_in_create()
    {
        $genreId=$this->saveGenre();
        $this->saveMovie($genreId);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/movie', ['title' => 'Titanic', 'genre_ids' => [$genreId]]);
        $response->assertStatus(201)->assertJsonFragment([
            'success' => true,
            'data' => null,
            'message' => 'Filme cadastrado com sucesso.'
        ]);
    }

    public function test_the_application_returns_a_success_response_in_find()
    {
        $genreId=$this->saveGenre();
        $movieId=$this->saveMovie($genreId);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/movie');
        $response->assertStatus(200)->assertJsonFragment([
            'success' => true,
            'data' => [["id" => $movieId, "release_date" => null, "title" => "Titanic"]],
            'message' => 'Filme encontrado com sucesso.'
        ]);
    }

    public function test_the_application_returns_a_success_response_in_findById()
    {
        $genreId=$this->saveGenre();
        $movieId=$this->saveMovie($genreId);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/movie/'.$movieId);
        $response->assertStatus(200)->assertJsonFragment([
            'success' => true,
            'data' => ["genre" => [["id" => $genreId, "name" => "Romance"]], "id" => $movieId, "overview" => null, "release_date" => null, "title" => "Titanic"],
            'message' => 'Filme encontrado com sucesso.'
        ]);
    }

    public function test_the_application_returns_a_success_response_in_update()
    {
        $genreId=$this->saveGenre();
        $movieId=$this->saveMovie($genreId);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/movie/'.$movieId, ['title' => 'Titanic', 'genre_ids' => [$genreId]]);
        $response->assertStatus(200)->assertJsonFragment([
            'success' => true,
            'data' => null,
            'message' => 'Filme atualizado com sucesso.'
        ]);;
    }

    private function saveGenre()
    {
        $genre = Genre::factory()->create();
        $genre->save();
        return $genre->id;
    }

    private function saveMovie(int $genreId)
    {
        $movie = Movie::factory()->create();
        $movie->save();
        $movie->genre()->attach($genreId);
        return $movie->id;
    }
}
