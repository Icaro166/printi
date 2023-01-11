<?php

namespace Tests\Feature\route\api\genre;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use RefreshDatabase;


    public function test_the_application_returns_a_fail_response_in_create()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/genre', []);
        $response->assertStatus(422);
    }

    public function test_the_application_returns_a_fail_response_in_find()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/genre');
        $response->assertStatus(404);
    }

    public function test_the_application_returns_a_fail_response_in_findById()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/genre/1');
        $response->assertStatus(404);
    }

    public function test_the_application_returns_a_fail_response_in_update()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/genre/1', []);
        $response->assertStatus(422);
    }

    public function test_the_application_returns_a_success_response_in_create()
    {
        $this->saveGenre();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/genre', ['name' => 'Romance']);
        $response->assertStatus(201)->assertJsonFragment([
            'success' => true,
            'data' => null,
            'message' => 'Gênero cadastrado com sucesso.'
        ]);
    }

    public function test_the_application_returns_a_success_response_in_find()
    {
        $genre = $this->saveGenre();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/genre');
        $response->assertStatus(200)->assertJsonFragment([
            'success' => true,
            'data' => [["id" => $genre->id, "name" => "Romance"]],
            'message' => 'Gênero encontrado com sucesso.'
        ]);
    }

    public function test_the_application_returns_a_success_response_in_findById()
    {
         $genre=$this->saveGenre();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/genre/'.$genre->id);
        $response->assertStatus(200)->assertJsonFragment([
            'success' => true,
            'data' => ["id" => $genre->id, "name" => "Romance"],
            'message' => 'Gênero encontrado com sucesso.'
        ]);
    }

    public function test_the_application_returns_a_success_response_in_update()
    {
       $genre= $this->saveGenre();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/genre/'.$genre->id, ['name' => 'Romance']);
        $response->assertStatus(200)->assertJsonFragment([
            'success' => true,
            'data' => null,
            'message' => 'Gênero atualizado com sucesso.'
        ]);;
    }

    private function saveGenre()
    {
        $genre = Genre::factory()->create();
        $genre->save();
        return $genre;
    }

}
