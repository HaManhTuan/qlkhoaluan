<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginLecPost extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|min:6'
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Email không được để trống',
            // 'email.unique'=>'Email này đã tồn tại',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu ít nhát 6 kí tự'
        ];
    }
}
