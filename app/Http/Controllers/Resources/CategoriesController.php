<?php

namespace App\Http\Controllers\Resources;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Create a new CategoriesController instance and set admin middlewares.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the App\Category.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withTrashed()->orderedPagination('updated_at', 20);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new App\Category instance.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Validate and store a new category instance in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = str_slug($request->name);
        $request['color'] = '';

        $this->validate($request, [
            'name' => 'between:3,250|unique:categories',
            'slug' => 'between:3,250|unique:categories',
        ], [
            'name.between' => 'Název kategorie musí mít mezi 3 a 250 znaky.',
            'name.unique' => 'Takto nazvaná kategorie už existuje.',
            'slug.unique' => 'Takto nazvaná kategorie už existuje.',
        ]);

        Category::create($request->all());
        flash(__('recipes.category.added'));

        return redirect()->route('admin.categories');
    }

    /**
     * Show the form for editing the specified App\Category instance.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified App\Category instance in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $this->validate($request, [
            'name' => 'between:3,250|unique:categories',
        ], [
            'name.between' => 'Název kategorie musí mít mezi 3 a 250 znaky.',
            'name.unique' => 'Takto nazvaná kategorie už existuje.',
        ]);

        $category->update($request->all());
        flash(__('recipes.category.updated'));

        return redirect()->route('admin.categories');
    }

}
