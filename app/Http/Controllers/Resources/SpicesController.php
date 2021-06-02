<?php

namespace App\Http\Controllers\Resources;

use App\Spice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpicesController extends Controller
{
    /**
     * Create a new SpicesController instance and set admin middlewares.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spices = Spice::withTrashed()->orderedPagination('updated_at', 20);

        return view('admin.spices.index', compact('spices'));
    }

    /**
     * Show the form for creating a new App\Spice instance.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.spices.create');
    }

    /**
     * Validate and store a new spice instance in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = str_slug($request->name);

        $this->validate($request, [
            'name' => 'between:3,250|unique:spices',
            'slug' => 'between:3,250|unique:spices',
        ], [
            'name.between' => 'Název koření musí mít mezi 3 a 250 znaky.',
            'name.unique' => 'Takto nazvané koření už existuje.',
            'slug.unique' => 'Takto nazvané koření už existuje.',
        ]);

        Spice::create($request->all());
        flash(__('recipes.spice.added'));

        return redirect()->route('admin.spices');
    }

    /**
     * Show the form for editing the specified App\Spice instance.
     * @param  \App\Spice  $spice
     * @return \Illuminate\Http\Response
     */
    public function edit(Spice $spice)
    {
        return view('admin.spices.edit', compact('spice'));
    }

    /**
     * Update the specified App\Spice instance in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spice  $spice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spice $spice)
    {
        $this->validate($request, [
            'name' => 'between:3,250|unique:spices',
        ], [
            'name.between' => 'Název koření musí mít mezi 3 a 250 znaky.',
            'name.unique' => 'Takto nazvané koření už existuje.',
        ]);

        $spice->update($request->all());
        flash(__('recipes.spice.updated'));

        return redirect()->route('admin.spices');
    }

}
