<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Lecturers;
class StoreRegisterPost extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email|unique:lecturers,email_address_lecturer',
            'password'=>'required|min:6',
            'phone'=>'required|numeric',
            'address'=>'required',
            'department'=>'required',
            'fields'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên không được để trống',
            'email.required'=>'Email không được để trống',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email này đã có người sử dụng',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu ít nhát 6 kí tự',
            'phone.required'=>'Số điện thoại không được để trống',
            'phone.numeric'=>'Số điện thoại phải là số',
            'address.required'=>'Hãy nhập địa chỉ',
            'department.required'=>'Khoa không được để trống',
            'fields.required' => 'Lĩnh vực không được để trống'
        ];
    }
}
