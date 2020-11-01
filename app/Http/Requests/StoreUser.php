<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'نام نمی تواند خالی باشد',
            'name.string' => 'نام باید رشته باشد',
            'name.max' => 'طول نام خیلی زیاد است',
            'email.required' => 'ایمیل احباری می باشد',
            'email.string' => 'ایمیل باید رشته باشد',
            'email.email' => 'ورودی باید فرمت ایمیل باشد',
            'email.max' => 'طول ایمیل خیلی زیاد است',
            'email.unique' => 'این آدرس ایمیل وجود دارد',
            'password.required' => 'کلمه عبور اجباریست',
            'password.string' => 'کلمه عبور باید رشته باشد',
            'password.min' => 'حداقل طول کلمه عور 6 حرف می باشد',
            'password.confirmed' => 'کلمات عبور همخوانی ندارند'
        ];
    }
}
