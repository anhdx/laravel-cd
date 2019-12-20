<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class checkOutRequest extends FormRequest
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
            'name'      =>'required',
            'email'     =>'required|email',
            'phone'     =>'required',
            'note'      =>'required|min:20',
            'address'   =>'required',
              ];
    }
    public function messages(){
        return [
            'name.required'    =>'Bạn chưa nhập tên.',
            'email.email'      =>'Emal không đúng định dạng.',
            'email.required'   =>'Bạn chưa nhập email.',
            'phone.required'   =>'Bạn chưa nhập số điện thoại.',
            'note.required'    =>'Bạn chưa nhập nội dung.',
            'note.min'          =>'Nội dung tối thiểu 20 ký tự.',
            'address.required' =>'Bạn chưa nhập địa chỉ.',
        ];
    }

}
