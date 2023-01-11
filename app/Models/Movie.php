<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @OA\Schema(
 *   description="Movie model",
 *   title="Movie",
 *   required={},
 *   @OA\Property(type="integer",description="id of Movie",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="title of Movie",title="title",property="title",example="Titanic",readOnly="true"),
 *   @OA\Property(type="date",description="release date of Movie",title="release_date",property="release_date",example="2002-07-04",readOnly="true"),
 *   @OA\Property(type="overview",description="overview of Movie",title="overview",property="overview",
 *     example="Um artista pobre e uma jovem rica se conhecem e se apaixonam na fatídica jornada do Titanic.",readOnly="true"),
 *   @OA\Property(title="genre",property="genre",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Genre"),
 *     ),
 *     )
 * )
 * @OA\Schema(
 *   schema="JsonResponseDefault",
 *   title="JsonResponseFind",
 *   @OA\Property(type="bool",description="success find movies",title="success",property="success",example="true",readOnly="true"),
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(
 *      example=null
 *     ),
 *   ),
 *   @OA\Property(type="string",description="success message",title="message",property="message",example="sucesso.",readOnly="true"),
 * )
 * @OA\Schema(
 *   schema="JsonResponseFind",
 *   title="JsonResponseFind",
 *   @OA\Property(type="bool",description="success find movies",title="success",property="success",example="true",readOnly="true"),
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(
 *      @OA\Property(type="integer",description="id of Movie",title="id",property="id",example="1",readOnly="true"),
 *      @OA\Property(type="string",description="title of Movie",title="title",property="title",example="Titanic",readOnly="true"),
 *      @OA\Property(type="date",description="release date of Movie",title="release_date",property="release_date",example="2002-07-04",readOnly="true"),
 *     ),
 *   ),
 *   @OA\Property(type="string",description="success message",title="message",property="message",example="Filme encontrado com sucesso.",readOnly="true"),
 * )
 *
 * @OA\Schema(
 *   schema="JsonResponseFindById",
 *   title="JsonResponseFindById",
 *   @OA\Property(type="bool",description="success find movies",title="success",property="success",example="true",readOnly="true"),
 *   @OA\Property(type="object",ref="#/components/schemas/Movie"),
 *   @OA\Property(type="string",description="success message",title="message",property="message",example="Filme encontrado com sucesso.",readOnly="true"),
 * )
 *
 *
 * @OA\Parameter(
 *      parameter="Movie--id",
 *      in="path",
 *      name="movie_id",
 *      required=true,
 *      description="Id of Movie",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */
class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'release_date',
        'overview',
        'tmdb_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
       'tmdb_id', 'created_at', 'updated_at','deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_date' => 'date:Y-m-d',
    ];
    public function genre()
    {
        return $this->belongsToMany(Genre::class)->using(GenreMovie::class);;
    }
}
