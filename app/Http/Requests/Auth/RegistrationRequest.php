<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Http\Requests\Request;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Validator;

class RegistrationRequest extends Request
{
    public function rules()
    {
        return [
            'role' => 'required|in:' . User::CUSTOMER . ',' . User::ADMINISTRATOR,
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|max:255|min:5',
            'phone' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => trans('publishers.email.unique'),
            'password.min' => trans('users.password.min'),
            'g-recaptcha-response.required_if' => trans('auth.on_recaptcha_error'),
        ];
    }

    protected function getFailedValidationMessage()
    {
        return trans('api.on_error');
    }

}
