<?php
namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class clientRequest extends FormRequest
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
            'subject'=>'required',
            'name'=>'required',
            'message'=>'required|min:20',
        ];
    }
    public function messages(){
        return[
               'email.required'=>'Bạn chưa nhập email',
               'email.email'=>'Email không đúng định dạng',
               'subject.required'=>'Bạn chưa nhập tiêu đề',
                'name.required'=>'Bạn chưa nhập tên',
                'message.required'=>'Bạn chưa nhập nội dung',
                'message.min'=>'Nội dung tối thiểu 20 ký tự',

        ];
    }
}
