<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'username'=>'sometimes|unique:users',
            'email'=>'required|unique:users',
            'name' => 'required|string',
            'password'=>'required|string|min:8',
            'phone' => 'required|numeric|digits_between:10,15',
            'photo_images' => 'sometimes|file|max:1000|mimes:jpg,bmp,png, jpeg'
        ];
    }
}
