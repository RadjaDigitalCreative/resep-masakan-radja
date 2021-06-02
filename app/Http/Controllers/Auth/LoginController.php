<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Socialite;
use App\Mail\Welcome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'E-mailovou adresu je nutné vyplnit.',
            'email.email' => 'E-mailová adresa je ve špatném formátu.',
            'password.required' => 'Zadejte své heslo.',
        ]);
    }

    /**
    * The user has been authenticated.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  mixed  $user
    * @return mixed
    */
    protected function authenticated(Request $request, $user)
    {
        flash(__('auth.logged'));
    }

    /**
     * Redirect the user to the provider's authentication page.
     *
     * @param  string  $provider
     * @return Response
     */
    private function redirectToProvider($provider = 'facebook')
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from given provider.
     *
     * @param  string  $provider
     * @return Response
     */
    private function handleProviderCallback($provider = 'facebook')
    {
        $userSocial = Socialite::driver($provider)->user();
        $user = User::where('email', $userSocial->email)->first();

        if (! $user) {
            $slug = $this->uniqueSlug(str_slug($userSocial->name));

            $user = User::create([
                'email' => $userSocial->email,
                'name' => $userSocial->name,
                'slug' => $slug,
                'password' => bcrypt(str_random(6)),
            ]);

            Mail::to($user)->send(new Welcome($user));
        }

        Auth::login($user);

        flash(__('auth.logged'));
    }

    /**
     * Create an unique user slug (if given slug exists).
     *
     * @param  string  $slug
     * @return string
     */
    private function uniqueSlug($slug)
    {
        $newSlug = $slug;
        $i = 0;

        while (User::where('slug', $newSlug)->exists()) {
            $newSlug = $slug.'-'.$i;
            $i++;
        }

        return $newSlug;
    }


    public function redirectToFacebook()
    {
        return $this->redirectToProvider('facebook');
    }

    public function redirectToTwitter()
    {
        return $this->redirectToProvider('twitter');
    }

    public function handleFacebookCallback()
    {
        $this->handleProviderCallback('facebook');

        return redirect($this->redirectTo);
    }

    public function handleTwitterCallback()
    {
        $this->handleProviderCallback('twitter');

        return redirect($this->redirectTo);
    }

}
