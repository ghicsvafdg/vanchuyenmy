<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'=>'required',
            'email'=>'required|unique:users|min:5',
            'password'=>'required',
            'confirmpass'=>'required',
            'role'=>'required'
        ];

    }

    public function messages(){
        return [
            'require'=>':attribute is not empty',
        ];
    }

    public function attributes(){
        return[
            'username'=>'Tên người dùng',
            'email'=>'Email',
            'password'=>'Mật khẩu',
            'confirmpass'=>'Mật khẩu',
            'role'=>'Vai trò'
        ];
    }
}
