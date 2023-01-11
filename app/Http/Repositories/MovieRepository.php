<?php

namespace App\Http\Repositories;

use App\Exceptions\BusinessException;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class MovieRepository extends BaseRepository
{


    public function model(): string
    {
        return Movie::class;
    }

    public function find(): Collection|array
    {
        $query = $this->model->newQuery();
        return $query->orderBy('title')->get(['id', 'title', 'release_date']);
    }

    public function findById(int $id, array $columns = ['*']): Model|Collection|Builder|array|null
    {
        $query = $this->model->newQuery();
        return $query->with('genre')->orderBy('title')->find($id);
    }

    /**
     * @throws BusinessException
     */
    public function create(array $input): bool|BusinessException
    {
        try {
            DB::beginTransaction();
            $model = $this->model->newInstance($input);
            $responseMovie = $model->save();
            $model->genre()->attach($input['genre_ids']);
            DB::commit();
            return $responseMovie;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new BusinessException($e);
        }
    }

    /**
     * @throws BusinessException
     */
    public function update(array $input, $id): Builder|bool|array|null
    {
        try {
            DB::beginTransaction();
            $query = $this->model->newQuery();
            $model = $query->findOrFail($id);
            $model->fill($input);
            $responseMovie = $model->save();
            if (array_key_exists('genre_ids',$input ) && count($input['genre_ids']) > 0){
                $model->genre()->sync($input['genre_ids']);
            }
            DB::commit();
            return $responseMovie;
        } catch (ModelNotFoundException  $e) {
            DB::rollBack();
            return false;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new BusinessException('Houve um erro ao atualizar o filme solicitado.');
        }
    }

    public function delete(int $id): mixed
    {
        try {
            return parent::delete($id);
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (\Exception $e) {
            throw new BusinessException('Houve um erro ao atualizar o filme solicitado.');
        }

    }

}
