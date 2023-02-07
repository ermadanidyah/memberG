<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\jabatan\Jabatan;
class MemberStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'password'=>'required|string|min:8',
            'phone' => 'required|numeric|digits_between:10,15',
            'photo_images' => 'required|file|max:1000|mimes:jpg,bmp,png, jpeg',
            'email' => 'required|string|unique:users',
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'no_ktp' => 'required|numeric',
            'alamat' => 'required|string',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required'
        ];
    }
}
