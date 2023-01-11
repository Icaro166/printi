<?php

namespace App\Http\Services;

use App\Exceptions\BusinessException;
use App\Http\Repositories\MovieRepository;
use Illuminate\Http\JsonResponse;

class MovieService extends Service
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function find(): JsonResponse
    {
        $movie = $this->movieRepository->find();
        if (count($movie->all()) > 0) {
            return $this->sendSuccess($movie, 'Filme encontrado com sucesso.');
        } else {
            return $this->sendError('Nenhum filme encontrado.');
        }
    }

    public function findById(int $id): JsonResponse
    {
        $movie = $this->movieRepository->findById($id);
        if ($movie != null) {
            return $this->sendSuccess($movie, 'Filme encontrado com sucesso.');
        } else {
            return $this->sendError('Nenhum filme encontrado.');
        }
    }

    /**
     * @return JsonResponse
     * @throws BusinessException
     */
    public function create(): JsonResponse
    {
        $movie = $this->movieRepository->create(request()->request->all());
        if ($movie) {
            return $this->sendSuccess(null, 'Filme cadastrado com sucesso.', 201);
        } else {
            return $this->sendError('Não foi possível cadastrar o filme solicitado.', 500);
        }
    }
    public function createByTMDB($request): JsonResponse
    {
        $movie = $this->movieRepository->create($request);
        if ($movie) {
            return $this->sendSuccess(null, 'Filme cadastrado com sucesso.', 201);
        } else {
            return $this->sendError('Não foi possível cadastrar o filme solicitado.', 500);
        }
    }
    /**
     * @throws BusinessException
     */
    public function update(int $id): JsonResponse
    {
        $movie = $this->movieRepository->update(request()->request->all(), $id);
        if ($movie) {
            return $this->sendSuccess(null, 'Filme atualizado com sucesso.');
        } else {
            return $this->sendError('Não foi encontrado o filme para fazer a atualização.');
        }
    }


    public function delete(int $id): JsonResponse
    {
        $movie = $this->movieRepository->delete($id);

        if ($movie) {
            return $this->sendSuccess(null, 'Filme excluído com sucesso.');
        } else {
            return $this->sendError('Não foi possível excluir o filme solicitado.');
        }
    }



}
