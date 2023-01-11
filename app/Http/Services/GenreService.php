<?php

namespace App\Http\Services;

use App\Http\Repositories\GenreRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class GenreService extends Service
{
    private GenreRepository $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function create(): JsonResponse
    {
        $genre = $this->genreRepository->create(request()->request->all());
        if ($genre) {
            return $this->sendSuccess(null, 'Gênero cadastrado com sucesso.', 201);
        } else {
            return $this->sendError('Não foi possível cadastrar o gênero solicitado.', 500);
        }
    }

    public function findById(int $id): JsonResponse
    {
        $genre = $this->genreRepository->findById($id);
        if ($genre != null) {
            return $this->sendSuccess($genre, 'Gênero encontrado com sucesso.');
        } else {
            return $this->sendError('Nenhum gênero encontrado.');
        }
    }

    public function update(int $id): JsonResponse
    {
        $error = false;
        try {
            $genre = $this->genreRepository->update(request()->request->all(), $id);
        }catch (ModelNotFoundException $e){
            $error = true;
        }
        if (!$error && $genre->exists ) {
            return $this->sendSuccess(null, 'Gênero atualizado com sucesso.');
        } else {
            return $this->sendError('Não foi encontrado o gênero para fazer a atualização.');
        }
    }

    public function delete(int $id): JsonResponse
    {
        $error = false;
        try {
            $genre = $this->genreRepository->delete($id);
        }catch (ModelNotFoundException $e){
            $error = true;
        }
        if (!$error && $genre) {
            return $this->sendSuccess(null, 'Gênero excluído com sucesso.');
        } else {
            return $this->sendError('Não foi possível excluir o gênero solicitado.');
        }
    }

    public function find(): JsonResponse
    {
        $genre = $this->genreRepository->find();
        if (count($genre->all()) > 0) {
            return $this->sendSuccess($genre, 'Gênero encontrado com sucesso.');
        } else {
            return $this->sendError('Nenhum gênero encontrado.');
        }
    }
}
