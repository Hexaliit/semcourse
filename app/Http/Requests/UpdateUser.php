<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'balance' => 'numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'نام نمی تواند خالی باشد',
            'email.required' => 'ایمیل احباری می باشد',
            'email.email' => 'ورودی باید فرمت ایمیل باشد',
            'email.unique' => 'این آدرس ایمیل وجود دارد',
            'balance.numeric' => 'موجودی کاربر باید عدد یاشد'
        ];
    }
}
