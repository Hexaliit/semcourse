<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
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
            'name' => 'required|alpha'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'نام دسته بندی نمی تواند خالی باشد',
            'name.alpha' => 'نام باید کاملا از حروف باشد'
        ];
    }
}
