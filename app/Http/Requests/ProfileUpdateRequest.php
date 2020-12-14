<?php


namespace App\Http\Requests;


use Illuminate\Http\Request;

class ProfileUpdateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()

    {

        return [
            'userId' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users'
        ];

    }
}
