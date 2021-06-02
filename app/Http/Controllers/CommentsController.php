<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
    /**
     * Create a new CommentsController instance and set middlewares.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Show the form for creating a new comment.
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $user = Auth::user()->load('recipes');
        $ids = [];

        foreach ($user->recipes as $recipe)
            if ($recipe->comments->count())
                $ids = array_merge($ids, $recipe->comments->pluck('id')->toArray());

        $comments = Comment::whereIn('id', $ids)->orderedPagination('updated_at', 20);

        return view('auth.comments', compact('comments'));
    }

    /**
     * Store a newly created comment in storage.
     * @param  \App\Http\Requests\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Recipe $recipe, CommentRequest $request)
    {
        $comment = new Comment($request->all());
        $comment->user_id = Auth::id();

        $recipe->comments()->save($comment);

        event(new \App\Events\RecipeCommented($recipe));
        flash(__('recipes.comment.added'));

        return redirect()->route('recipes.show', $recipe->slug);
    }

    /**
     * Remove the specified comment from storage.
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (Auth::id() == $comment->user_id || Auth::user()->isAdmin()) {
            $comment->delete();

            flash(__('recipes.comment.deleted'));
        }
        $url = \URL::previous();
        return $url ? redirect($url) : redirect()->route('comments.list');
    }

}
