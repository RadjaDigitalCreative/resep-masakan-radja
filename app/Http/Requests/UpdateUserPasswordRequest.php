<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\PasswordMismatchException;

class UpdateUserPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::where('id', $this->id)->where('id', Auth::id());

        return $user->exists() &&
                Hash::check($this->password, $user->first()->password);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:6',
            'newpassword' => 'required|min:6|confirmed',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'password.min' => 'Špatně zadané heslo.',
            'password.required' => 'Současné heslo je nutné vyplnit.',
            'newpassword.required' => 'Nové heslo je nutné vyplnit.',
            'newpassword.min' => 'Heslo musí mít alespoň :min znaků.',
            'newpassword.confirmed' => 'Kontrolní heslo se neshoduje s tím prvním.',
        ];
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new PasswordMismatchException(__('auth.settings.password_failed'));
    }

}
