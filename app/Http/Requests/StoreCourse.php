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
            'title' => 'required|unique:courses',
            'content' => 'required',
            'price' => 'required|numeric',
            'avatar' => 'mimes:jpeg,bmp,png,jpg|max:1024',
            'source' => 'mimes:pdf,txt,ppt,zip,rar|max:7000',
            'category' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'عنوان دوره نمی تواند خالی باشد',
            'title.unique' => 'عنوان دوره از قبل وجود دارد',
            'content.required' => 'محتوی دوره نمی تواند خالی باشد',
            'price.required' => 'قیمت دوره نمی تواند خالی باشد',
            'price.numeric' => 'قیمت باید فقط از اعداد تشکیل شود',
            'avatar.mimes' => 'فرمت فایل پشتیبانی نمی شود',
            'avatar.max' => 'حجم عکس نباید بیشتر از 1MB باشد',
            'source.mimes' => 'فرمت فایل پشتیبانی نمی شود',
            'source.max' => 'فحجم فایل نباید بیشتر از 7MB باشد',
            'category.required' => 'دسته بندی اجباری می باشد'
        ];
    }
}
