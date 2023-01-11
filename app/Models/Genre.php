<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *   description="Genre model",
 *   title="Genre",
 *   required={},
 *   @OA\Property(type="integer",description="id of Genre",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="name of Genre",title="name",property="name",example="Romance",readOnly="true"),
 * )
 * @OA\Parameter(
 *      parameter="Genre--id",
 *      in="path",
 *      name="genre_id",
 *      required=true,
 *      description="Id of Genre",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 * @OA\Schema(
 *   schema="JsonResponseFindByIdGenre",
 *   title="JsonResponseFind",
 *   @OA\Property(type="bool",description="success find movies",title="success",property="success",example="true",readOnly="true"),
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(
 *      ref="#/components/schemas/Genre"
 *     ),
 *   ),
 *   @OA\Property(type="string",description="success message",title="message",property="message",example="sucesso.",readOnly="true"),
 * )
 * @OA\Schema(
 *   schema="JsonResponseFindGenre",
 *   title="JsonResponseFind",
 *   @OA\Property(type="bool",description="success find movies",title="success",property="success",example="true",readOnly="true"),
 *   @OA\Property(title="data",property="data",type="object", ref="#/components/schemas/Genre"),
 *   @OA\Property(type="string",description="success message",title="message",property="message",example="sucesso.",readOnly="true"),
 * )
 * @OA\Schema(
 *   schema="JsonResponseDefaultGenre",
 *   title="JsonResponseFind",
 *   @OA\Property(type="bool",description="success find movies",title="success",property="success",example="true",readOnly="true"),
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(
 *      example=null
 *     ),
 *   ),
 *   @OA\Property(type="string",description="success message",title="message",property="message",example="sucesso.",readOnly="true"),
 * )
 */
class Genre extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
               "created_at",
               "updated_at",
                "pivot",
    ];

    public function movie()
    {
        return $this->belongsToMany(Movie::class)->using(GenreMovie::class);
    }
}
