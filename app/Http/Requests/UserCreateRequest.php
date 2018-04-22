<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::user()->role == "admin");;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "username" => "required|unique:users,username",
            "role" => "required",
            "password" => "required"
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Naam is verplicht',
            'username.required'  => 'Inlognaam is verplicht',
            'username.unique'  => 'Inlognaam is al in gebruik',
            'role.required'  => 'Rol is verplicht',
            "password.required" => "Wachtwoord is verplicht"
        ];
    }
}
