<?php

namespace App\Http\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class TheMovieAPIService extends Service
{
    public function find(): JsonResponse
    {
        $query = $this->replace(request());
        $result = Http::asJson()->get(config('services.tmdb.listMovies') . $query . "&page=" . request()->page)->json();
        if ((array_key_exists('success', $result) && $result['success']) ||
            (array_key_exists('results', $result) && count($result['results']) > 0)) {
            return $this->sendSuccess($this->convertTMDBResultArrayInMovie($result), 'Filme encontrado com sucesso na api TMDB.');
        } else {
            return $this->sendError('Filme não encontrado na api TMDB.');
        }
    }

    private function replace($request): string
    {
        return str_replace(" ", "+", $request->title);
    }

    private function convertTMDBResultArrayInMovie($tmdbResults): array
    {
        $movies = [];
        foreach ($tmdbResults['results'] as $result) {
            $movie = [
                'title' => $result['title'] ?? null,
                'release_date' => $result['release_date'] ?? null,
                'overview' => $result['overview'] ?? null,
                'tmdb_id' => $result['id'] ?? null,
                'genre_ids' => $result['genre_ids'] ?? null
            ];
            array_push($movies, $movie);
        }
        return [
            'page' => $tmdbResults['page'],
            'result' => $movies,
            'total_pages' => $tmdbResults['total_pages']
        ];

    }
}
