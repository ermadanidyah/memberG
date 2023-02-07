<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;
class MemberUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password'=>'sometimes|string|min:8',
            'phone' => 'sometimes|numeric|digits_between:10,15',
            'photo_images' => 'sometimes|file|max:1000|mimes:jpg,bmp,png, jpeg',
            'email' => 'sometimes|string',
            'nama' => 'sometimes|string',
            'tanggal_lahir' => 'sometimes|date',
            'no_ktp' => 'sometimes|numeric',
            'alamat' => 'sometimes|string',
            'provinsi' => 'sometimes',
            'kabupaten' => 'sometimes',
            'kecamatan' => 'sometimes'
        ];
    }
}
