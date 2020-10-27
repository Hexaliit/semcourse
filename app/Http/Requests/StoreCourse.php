<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourse extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'price' => 'required|numeric',
            'avatar' => 'image',
            'source' => 'file'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'عنوان دوره نمی تواند خالی باشد',
            'content.required' => 'محتوی دوره نمی تواند خالی باشد',
            'price.required' => 'قیمت دوره نمی تواند خالی باشد',
            'price.numeric' => 'قیمت باید فقط از اعداد تشکیل شود',
            'avatar.image' => 'فایل آپلود شده حتما باید عکس باشد',
            'source.file' => 'فایل آپلود شده قابل قبول نیست'
        ];
    }
}
