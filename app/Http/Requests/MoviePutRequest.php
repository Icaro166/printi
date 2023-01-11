<?php

namespace App\Http\Requests;

use App\Rules\GenreRule;
use Illuminate\Foundation\Http\FormRequest;

class MoviePutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'max:80',
            'release_date' => 'date',
            'overview' => 'max:65535',
            'tmdb_id' => 'integer',
            'genre_ids' => ['array',new GenreRule()],
            'genre_ids.*' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'O campo título pode conter no máximo 80 caracteres.',
            'overview.max' => 'O campo descrição pode conter no máximo 80 caracteres.',
            'release_date' => 'O campo data de lançamento não contem uma data valida.',
            'genre_ids.*.integer' => 'O campo gênero pode conter apenas array de inteiros.',
            'genre_ids.array' => 'O campo gênero pode conter apenas array de inteiros.',
            'integer' => 'O campo :attribute aceita apenas inteiros.',
        ];
    }
}
