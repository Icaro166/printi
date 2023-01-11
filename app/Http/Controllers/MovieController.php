<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use App\Http\Requests\MoviePostRequest;
use App\Http\Requests\MoviePutRequest;
use App\Http\Services\MovieService;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    private MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * @OA\Get(
     *  path="/api/movie",
     *  operationId="indexMovie",
     *  tags={"Movie"},
     *  summary="Get list of Movie",
     *  description="Returns list of Movie",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/JsonResponseFind"),
     *  ),
     *   @OA\Response(response="404",description="Movie not found"),
     * )
     *
     * Display a listing of Movie.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->movieService->find();
    }


    /**
     * @OA\Post(
     *  operationId="storeMovie",
     *  summary="Insert a new Movie",
     *  description="Insert a new Movie",
     *  tags={"Movie"},
     *  path="/api/movie",
     *  @OA\RequestBody(
     *    description="Movie to create",
     *    required=true,
     *      @OA\JsonContent(
     *              type="object",
     *                example={
     *                  "title": "Titanic",
     *                  "release_date": "1994-06-23",
     *                  "overview": "Um artista pobre e uma jovem rica se conhecem e se apaixonam na fatídica jornada do Titanic",
     *                  "genre_ids": {10749}
     *                }
     *      )
     *  ),
     *  @OA\Response(response="201",description="Movie created",
     *    @OA\JsonContent(ref="#/components/schemas/JsonResponseDefault"),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     * @param MoviePostRequest $request
     * @return JsonResponse
     * @throws BusinessException
     */
    public function store(MoviePostRequest $request): JsonResponse
    {
        return $this->movieService->create();
    }

    /**
     * @OA\Get(
     *  path="/api/movie/{movie_id}",
     *  operationId="showMovie",
     *  tags={"Movie"},
     *  summary="Get a Movie by his id",
     *  description="Returns list of Movie",
     * @OA\Parameter(ref="#/components/parameters/Movie--id"),
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/JsonResponseFindById"),
     *  ),
     *  @OA\Response(response="404",description="Movie not found"),
     * )
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->movieService->findById($id);
    }


    /**
     * @OA\Put(
     *   operationId="updateMovie",
     *   summary="Update an existing Movie",
     *   description="Update an existing Movie",
     *   tags={"Movie"},
     *   path="/api/movie/{movie_id}",
     *   @OA\Parameter(ref="#/components/parameters/Movie--id"),
     *   @OA\Response(response="200",description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/JsonResponseDefault"),
     * ),
     *   @OA\Response(response=404,description="Movie not found"),
     *   @OA\Response(response=422,description="Validation exception"),
     *   @OA\RequestBody(
     *     description="Movie to update",
     *     required=true,
     *      @OA\JsonContent(
     *              type="object",
     *                example={
     *                  "release_date": "1995-06-23",
     *        }
     *      )
     *   )
     * )
     * @param MoviePutRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws BusinessException
     */
    public function update(MoviePutRequest $request, int $id): JsonResponse
    {
        return $this->movieService->update($id);
    }

    /**
     * @OA\Delete(
     *  path="/api/movie/{movie_id}",
     *  summary="Delete a Movie",
     *  description="Delete a Movie",
     *  operationId="destroyMovie",
     *  tags={"Movie"},
     *  @OA\Parameter(ref="#/components/parameters/Movie--id"),
     *  @OA\Response(response=200,description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/JsonResponseDefault"),
     * ),
     *  @OA\Response(response=404,description="Movie not found"),
     * )
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->movieService->delete($id);
    }
}
