<?php

namespace Tests\Feature\route\api\tmdbApi;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TmdbApiTest extends TestCase
{
    use RefreshDatabase;


    public function test_the_application_returns_a_fail_response_in_find()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/the-movie-api');
        $response->assertStatus(404);
    }



    public function test_the_application_returns_a_success_response_in_find()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/the-movie-api?title=titanic');
        $response->assertStatus(200);
    }


}
