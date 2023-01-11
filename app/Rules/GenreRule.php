<?php

namespace App\Rules;

use App\Models\Genre;
use Illuminate\Contracts\Validation\Rule;
use PHPUnit\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GenreRule implements Rule
{


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
           $genre = Genre::find($value);
           if (count($value) == count($genre->all())){
               return true;
               }else{
               return false;
           }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O genre_id informado não está cadastrado.';
    }
}
