<?php

// Route::get('/', function () {
//     return view('welcome');
// });
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::get('/', 'PagesController@index')->name('home');
Route::get('/search', 'PagesController@search')->name('search');
Route::get('/search2', 'PagesController@search2')->name('search2');
Route::get('/search3', 'PagesController@search3')->name('search3');
Route::get('nejnovejsi', 'PagesController@recipes')->name('new.recipes');
Route::get('kategorie', 'PagesController@categories')->name('categories');
Route::get('zebricky', 'PagesController@rankings')->name('rankings');

Route::get('kategorie/{category}', 'PagesController@categories')->name('category');

Route::get('home', function() { return redirect('/'); });

// Recipes
Route::get('recept/novy', 'RecipesController@create')->name('recipes.create');
Route::post('recept', 'RecipesController@store')->name('recipes.store');

Route::get('moje-recepty', 'RecipesController@userRecipes')->name('recipes.auth');
Route::get('moje-oblibene', 'RecipesController@userLikes')->name('likes.auth');

Route::get('recept/{recipe}/edit', 'RecipesController@edit')->name('recipes.edit');
Route::put('recept/{recipe}', 'RecipesController@update')->name('recipes.update');
Route::delete('recept/{recipe}', 'RecipesController@destroy')->name('recipes.destroy');
Route::post('recept/{recipe}/obnovit', 'RecipesController@restore')->name('recipes.restore');

Route::get('recept/{recipeSlug}', 'RecipesController@show')->name('recipes.show');
Route::post('recept/{recipe}/like', 'RecipesController@like')->name('recipes.like');

// Comments
Route::get('nastaveni/komentare', 'CommentsController@list')->name('comments.list');
Route::post('recept/{recipe}/komentar', 'CommentsController@store')->name('comments.store');
Route::delete('komentar/{comment}', 'CommentsController@destroy')->name('comments.destroy');


