<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Http\Services\GenreService;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    private GenreService $genreService;

    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }
    /**
     * @OA\Get(
     *  path="/api/genre",
     *  operationId="indexGenre",
     *  tags={"Genre"},
     *  summary="Get list of Genre",
     *  description="Returns list of Genre",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/JsonResponseFindGenre"),
     *  ),
     *   @OA\Response(response="404",description="Genre not found"),
     * )
     *
     * Display a listing of Genre.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->genreService->find();
    }


    /**
     * @OA\Post(
     *  operationId="storeGenre",
     *  summary="Insert a new Genre",
     *  description="Insert a new Genre",
     *  tags={"Genre"},
     *  path="/api/genre",
     *  @OA\RequestBody(
     *    description="Genre to create",
     *    required=true,
     *      @OA\JsonContent(
     *              type="object",
     *                example={
     *                  "name": "Suspense",
     *                }
     *      )
     *  ),
     *  @OA\Response(response="201",description="Genre created",
     *     @OA\JsonContent(ref="#/components/schemas/JsonResponseDefaultGenre"),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     * @param GenreRequest $request
     * @return JsonResponse
     */
    public function store(GenreRequest $request) : JsonResponse
    {
        return $this->genreService->create();
    }

    /**
     * @OA\Get(
     *  path="/api/genre/{genre_id}",
     *  operationId="showGenre",
     *  tags={"Genre"},
     *  summary="Get a Genre by his id",
     *  description="Returns list of Genre",
     * @OA\Parameter(ref="#/components/parameters/Genre--id"),
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/JsonResponseFindByIdGenre"),
     *  ),
     *  @OA\Response(response="404",description="Genre not found"),
     * )
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->genreService->findById($id);
    }


    /**
     * @OA\Put(
     *   operationId="updateGenre",
     *   summary="Update an existing Genre",
     *   description="Update an existing Genre",
     *   tags={"Genre"},
     *   path="/api/genre/{genre_id}",
     *   @OA\Parameter(ref="#/components/parameters/Genre--id"),
     *   @OA\Response(response="200",description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/JsonResponseDefaultGenre"),
     * ),
     *   @OA\Response(response=404,description="Genre not found"),
     *   @OA\Response(response=422,description="Validation exception"),
     *   @OA\RequestBody(
     *     description="Genre to update",
     *     required=true,
     *      @OA\JsonContent(
     *              type="object",
     *                example={
     *                  "name": "Suspense",
     *        }
     *      )
     *   )
     * )
     * @param GenreRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(GenreRequest $request, int $id): JsonResponse
    {
        return $this->genreService->update($id);
    }

    /**
     * @OA\Delete(
     *  path="/api/genre/{genre_id}",
     *  summary="Delete a Genre",
     *  description="Delete a Genre",
     *  operationId="destroyGenre",
     *  tags={"Genre"},
     *  @OA\Parameter(ref="#/components/parameters/Genre--id"),
     *  @OA\Response(response=200,description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/JsonResponseDefaultGenre"),
     * ),
     *  @OA\Response(response=404,description="Genre not found"),
     * )
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->genreService->delete($id);
    }
}
