<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::where('id', Auth::id());

        return $user->exists() &&
               $user->first()->role_id > 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $title_unique = '';
        $slug_unique = '';

        if ($this->id) {
            $title_unique = ',title,'.$this->id;
            $slug_unique = ',slug,'.$this->id;
        }

        return [
            'title' => 'required|min:6|max:60|unique:recipes'.$title_unique,
            'slug' => 'required|min:6|max:60|alpha_dash|unique:recipes'.$slug_unique,
            'categories'  => 'required|array|min:1',
            'ingredients'  => 'required|array|min:1',
            'thumbnail'  => 'image|image_size:<3000',
            'body' => 'min:30',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'title.required' => 'Název receptu je nutné vyplnit.',
            'title.min' => 'Název receptu musí mít alespoň :min znaků.',
            'title.max' => 'Název receptu nesmí přesáhnout :max znaků.',
            'title.unique' => 'Takto nazvaný recept už existuje.',
            'slug.unique' => 'Takto nazvaný recept už existuje.',
            'categories.required' => 'Zařaďte recept minimálně do jedné kategorie.',
            'ingredients.required' => 'Bez surovin nic neuvaříte.',
            'thumbnail.image' => 'Obrázek je ve špatném formátu.',
            'thumbnail.image_size' => 'Obrázek nesmí přesáhnout velikost 3000 px.',
            'body.min' => 'Text receptu musí mít alespoň :min znaků.',
        ];
    }

    /**
     * Modify the input, create the slug.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $input = $this->all();

        if (!isset($input['slug']))
            $input['slug'] = str_slug($input['title']);

        if (!isset($input['spices']))
            $input['spices'] = [];

        $this->replace($input);
    }

}
