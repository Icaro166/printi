<?php

namespace App\Http\Controllers;

use App\Http\Services\TheMovieAPIService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TheMovieAPIController extends Controller
{
    private TheMovieAPIService $theMovieAPIService;

    public function __construct(TheMovieAPIService $theMovieAPIService)
    {
        $this->theMovieAPIService = $theMovieAPIService;
    }

    /**
     * @OA\Get(
     *  path="/api/the-movie-api",
     *  operationId="indexTMDB",
     *  tags={"TMDB"},
     *  summary="Get movie list from tmdb api",
     *  description="Returns list of Movie from tmdb api",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(
     *     @OA\Property(type="bool",description="success find movies",title="success",property="success",example="true",readOnly="true"),
     *     @OA\Property(title="data",property="data",type="array",
     *     @OA\Items(
     *      example={
     *              "page":1,
     *              "result":{{
     *                  "id": 1,
     *                  "title": "Titanic",
     *                  "release_date": "2002-07-04",
     *                  "overview": "Um artista pobre e uma jovem rica se conhecem e se apaixonam na fatídica jornada do Titanic.",
     *                  "genre": {
     *                      1,
     *                      2
     *                    },
     *                  },},
     *              "total_pages": 1,
     *          }
     *     ),
     * ),
     *   @OA\Property(type="string",description="success message",title="message",property="message",example="sucesso.",readOnly="true"),
     *
     *     )
     *
     *  ),
     *      @OA\Parameter(
     *      parameter="Movie--title",
     *      in="query",
     *      name="title",
     *      required=true,
     *      description="title of Movie",
     *      @OA\Schema(
     *          type="string",
     *          example="titanic",
     *      )
     * ),
     *     @OA\Parameter(
     *      parameter="Movie--page",
     *      in="query",
     *      name="page",
     *      required=true,
     *      description="page of TMDB api",
     *      @OA\Schema(
     *          type="integer",
     *          example="1",
     *      )
     * ),
     *   @OA\Response(response="404",description="Movie not found"),
     * )
     *
     * Display a listing of Movie.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->theMovieAPIService->find();
    }
}
