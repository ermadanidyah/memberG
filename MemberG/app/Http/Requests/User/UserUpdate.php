<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'=>'sometimes',
            'name' => 'sometimes|string',
            'password'=>'sometimes|string|min:8',
            'username'=>'sometimes',
            'phone' => 'sometimes|numeric|digits_between:10,15',
            'photo_images' => 'sometimes|file|max:1000|mimes:jpg,bmp,png, jpeg'
        ];
    }
}
