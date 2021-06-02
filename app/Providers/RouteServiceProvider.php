<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        // Get User, even the deleted one
        Route::bind('user', function($value) {
            return \App\User::withTrashed()->where('id', $value)->firstOrFail();
        });
        // Get User by slug in the URL
        Route::bind('userSlug', function($value) {
            return \App\User::where('slug', $value)->firstOrFail();
        });

        // Get Recipe, even the deleted one
        Route::bind('recipe', function($value) {
            return \App\Recipe::withTrashed()->where('id', $value)->firstOrFail();
        });
        // Get Recipe by slug for detail page
        Route::bind('recipeSlug', function($value) {
            return \App\Recipe::where('slug', $value)->firstOrFail();
        });

        // Get Category by slug in the URL
        Route::bind('category', function($value) {
            return \App\Category::where('slug', $value)->firstOrFail();
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));

        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/auth.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
