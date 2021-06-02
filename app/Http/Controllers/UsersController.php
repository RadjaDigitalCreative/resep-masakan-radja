<?php

namespace App\Http\Controllers;

use App\User;
use App\Recipe;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserEmailRequest;
use App\Http\Requests\UpdateUserPasswordRequest;

class UsersController extends Controller
{
    /**
     * Create a new UsersController instance and set middlewares.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a profile page of the specified user.
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $recipes = Recipe::whereIn('id', $user->recipes->pluck('id'))
        ->orderedPagination('updated_at', 12);

        return view('auth.show', compact('user', 'recipes'));
    }


    /**
     * Show the form for editing the logged user.
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('auth.edit')->with('user', Auth::user());
    }

    /**
     * Show the email change form for the logged user.
     * @return \Illuminate\Http\Response
     */
    public function editEmail()
    {
        return view('auth.edit-email')->with('user', Auth::user());
    }

    /**
     * Show the password change form for the logged user.
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('auth.edit-password')->with('user', Auth::user());
    }


    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $user->fill($request->all());

        if ($request->hasFile('avatar')) {
            $user->saveAvatar($request->file('avatar'));
        }
        if ($request->hasFile('cover')) {
            $user->saveCover($request->file('cover'));
        }
        $user->save();
        flash(__('auth.settings.user_saved'));

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\UpdateUserEmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(UpdateUserEmailRequest $request)
    {
        $user = Auth::user();
        $user->fill($request->all());
        $user->save();

        $user->unconfirmEmail();
        $user->sendEmailVerification();
        flash(__('auth.settings.email_saved'));

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\UpdateUserPasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->newpassword);

        $user = Auth::user();
        $user->fill($data);
        $user->save();
        flash(__('auth.settings.password_saved'));

        return redirect()->back();
    }

    /**
     * Soft delete the specified user.
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->isAdmin() || Auth::id() == $user->id) {
            $user->delete();

            flash(__('auth.deleted'));
        }
        return redirect()->route('admin.users');
    }
    /**
     * Bring user back to life.
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function restore(User $user)
    {
        if (Auth::user()->isAdmin()) {
            $user->restore();

            flash(__('auth.restored'));
        }
        return redirect()->route('admin.users');
    }

}
