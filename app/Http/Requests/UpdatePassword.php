<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
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
            'password' => 'required|min:6|confirmed',
            'oldPass' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'oldPass.required' => 'کلمه عبور قبلی اجباریست',
            'password.required' => 'کلمه عبور جدید اجباریست',
            'password.min' => 'حداقل طول کلمه عور 6 حرف می باشد',
            'password.confirmed' => 'کلمات عبور همخوانی ندارند'
        ];
    }
}
