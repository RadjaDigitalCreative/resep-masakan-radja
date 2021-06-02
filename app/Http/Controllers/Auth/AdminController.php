<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Spice;
use App\Recipe;
use App\Comment;
use App\Category;
use Carbon\Carbon;
use App\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;

class AdminController extends Controller
{
    /**
     * Create a new AdminController instance and set admin middlewares.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('admin');
    }

    /**
     * Application model classes.
     * @var string
     */
    protected $classes = [
        // 'Uživatelé' => User::class,
        // 'Komentáře' => Comment::class,
        // 'Recepty' => Recipe::class,
        // 'Kategorie' => Category::class,
        // 'Suroviny' => Ingredient::class,
        // 'Koření' => Spice::class,
        'User' => User::class,
        'Komentar' => Comment::class,
        'Resep' => Recipe::class,
        'Kategori' => Category::class,
        'Bahan' => Ingredient::class,
        'Bumbu' => Spice::class,
    ];

    /**
     * Show the admin's dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        foreach ($this->classes as $name => $class) {
            $classData = [];
            $classData['name'] = $name;
            $classData['class'] = class_basename($class);
            $classData['total'] = $class::count();
            $classData['year'] = $class::select('', \DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', date('Y'))->count();
            $classData['month'] = $class::select('', \DB::raw('count(*) as total'))
            ->whereYear('created_at', '=', date('Y'))
            ->whereMonth('created_at', '=', date('m'))->count();
            $classData['week'] = $class::select('', \DB::raw('count(*) as total'))
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ])->count();

            $data[] = $classData;
        }

        return view('admin.index', compact('data', 'otherCounts'));
    }

    // Users
    public function users()
    {
        $users = User::withTrashed()->latest('updated_at')
        ->paginate(25, ['*'], __('pagination.page'));

        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {
        $input = $request->all();

        $user->fill($request->all());

        if ($request->deleteAvatar) {
            $user->deleteAvatar();
        }
        if ($request->deleteCover) {
            $user->deleteCover();
        }
        $user->save();
        flash(__('auth.updated'));

        return redirect()->route('admin.users');
    }

    // Comments
    public function comments()
    {
        $comments = Comment::orderedPagination('updated_at', 25);

        return view('admin.comments.index', compact('comments'));
    }

    // Recipes
    public function recipes()
    {
        $recipes = Recipe::withTrashed()->orderedPagination('updated_at', 25);

        return view('admin.recipes.index', compact('recipes'));
    }


}
