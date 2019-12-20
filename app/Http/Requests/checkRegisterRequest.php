<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class checkRegisterRequest extends FormRequest
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
     * @return arraypassword
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'password_confirmation'=>'same:password',
        ];
    }
    public function messages(){

        return [
            'name.required'=>'Bạn chưa nhập tên',
            'email.email'=>'Email không đúng định dạng',
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu tối thiểu có 6 ký tự',
            'password_confirmation.same'=>'nhập lại mật khẩu không đúng',

        ];
    }
}
