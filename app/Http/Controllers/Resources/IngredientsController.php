<?php

namespace App\Http\Controllers\Resources;

use App\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IngredientsController extends Controller
{
    /**
     * Create a new IngredientsController instance and set admin middlewares.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the App\Ingredient.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::withTrashed()->orderedPagination('updated_at', 20);

        return view('admin.ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new App\Ingredient instance.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ingredients.create');
    }

    /**
     * Validate and store a new ingredient in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = str_slug($request->name);

        $this->validate($request, [
            'name' => 'between:3,250|unique:ingredients',
            'slug' => 'between:3,250|unique:ingredients',
        ], [
            'name.between' => 'Název suroviny musí mít mezi 3 a 250 znaky.',
            'name.unique' => 'Takto nazvaná surovina už existuje.',
            'slug.unique' => 'Takto nazvaná surovina už existuje.',
        ]);

        Ingredient::create($request->all());
        flash(__('recipes.ingredient.added'));

        return redirect()->route('admin.ingredients');
    }

    /**
     * Show the form for editing the specified App\Ingredient instance.
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified App\Ingredient instance in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $this->validate($request, [
            'name' => 'between:3,250|unique:ingredients',
        ], [
            'name.between' => 'Název suroviny musí mít mezi 3 a 250 znaky.',
            'name.unique' => 'Takto nazvaná surovina už existuje.',
        ]);

        $ingredient->update($request->all());
        flash(__('recipes.ingredient.updated'));

        return redirect()->route('admin.ingredients');
    }

}
