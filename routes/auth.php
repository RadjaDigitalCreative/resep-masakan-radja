<?php

// Authentication Routes
Route::get('prihlasit', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('prihlasit', 'Auth\LoginController@login');
Route::post('odhlasit', 'Auth\LoginController@logout')->name('logout');

Route::get('prihlasit/facebook', 'Auth\LoginController@redirectToFacebook')->name('login.facebook');
Route::get('prihlasit/facebook/zpet', 'Auth\LoginController@handleFacebookCallback');
Route::get('prihlasit/twitter', 'Auth\LoginController@redirectToTwitter')->name('login.twitter');
Route::get('prihlasit/twitter/zpet', 'Auth\LoginController@handleTwitterCallback');

// Registration Routes
Route::get('registrace', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('registrace', 'Auth\RegisterController@register');
Route::get('registrace/overeni/{token}', 'Auth\RegisterController@confirmEmail');

// Password Reset Routes
Route::get('heslo/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('heslo/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('heslo/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('heslo/reset', 'Auth\ResetPasswordController@reset');

// User Profile & Management Routes
Route::get('uzivatel/nastaveni', 'UsersController@edit')->name('settings');
Route::get('uzivatel/nastaveni/email', 'UsersController@editEmail')->name('settings.email');
Route::get('uzivatel/nastaveni/heslo', 'UsersController@editPassword')->name('settings.password');

Route::get('uzivatel/{userSlug}', 'UsersController@show')->name('user.profile');
Route::put('uzivatel/nastaveni', 'UsersController@update')->name('user.update');
Route::put('uzivatel/nastaveni/email', 'UsersController@updateEmail')->name('user.update.email');
Route::put('uzivatel/nastaveni/heslo', 'UsersController@updatePassword')->name('user.update.password');

// Admin
Route::get('administrace', 'Auth\AdminController@index')->name('admin');
Route::get('administrace/user', 'Auth\AdminController@users')->name('admin.users');
Route::get('administrace/uzivatel/{user}', 'Auth\AdminController@editUser')->name('admin.users.edit');
Route::put('administrace/uzivatel/{user}', 'Auth\AdminController@updateUser')->name('admin.users.update');
Route::delete('administrace/uzivatel/{user}', 'UsersController@destroy')->name('admin.users.destroy');
Route::post('administrace/uzivatel/{user}/obnovit', 'UsersController@restore')->name('admin.users.restore');
Route::get('administrace/resep', 'Auth\AdminController@recipes')->name('admin.recipes');
Route::get('administrace/komentar', 'Auth\AdminController@comments')->name('admin.comments');

Route::get('administrace/bahan', 'Resources\IngredientsController@index')->name('admin.ingredients');
Route::get('administrace/surovina/nova', 'Resources\IngredientsController@create')->name('admin.ingredients.create');
Route::post('administrace/surovina', 'Resources\IngredientsController@store')->name('admin.ingredients.store');
Route::get('administrace/surovina/{ingredient}', 'Resources\IngredientsController@edit')->name('admin.ingredients.edit');
Route::put('administrace/surovina/{ingredient}', 'Resources\IngredientsController@update')->name('admin.ingredients.update');
Route::get('administrace/bumbu', 'Resources\SpicesController@index')->name('admin.spices');
Route::get('administrace/koreni/nove', 'Resources\SpicesController@create')->name('admin.spices.create');
Route::post('administrace/koreni', 'Resources\SpicesController@store')->name('admin.spices.store');
Route::get('administrace/koreni/{spice}', 'Resources\SpicesController@edit')->name('admin.spices.edit');
Route::put('administrace/koreni/{spice}', 'Resources\SpicesController@update')->name('admin.spices.update');
Route::get('administrace/kategori', 'Resources\CategoriesController@index')->name('admin.categories');
Route::get('administrace/kategorie/nova', 'Resources\CategoriesController@create')->name('admin.categories.create');
Route::post('administrace/kategorie', 'Resources\CategoriesController@store')->name('admin.categories.store');
Route::get('administrace/kategorie/{categoryId}', 'Resources\CategoriesController@edit')->name('admin.categories.edit');
Route::put('administrace/kategorie/{categoryId}', 'Resources\CategoriesController@update')->name('admin.categories.update');
