<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideo extends FormRequest
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
            'title' => 'required|min:3|max:32',
            'video' => 'required|mimes:mp4,mpeg,avi|file|max:7000'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'عنوان ویدیو نمی تواند خالی باشد',
            'title.min' => 'عنوان ویدیو حداقل ۳ کاراکتر است',
            'title.max' => 'عنوان ویدیو حداکثر ۳۲ کاراکتر است',
            'video.required' => 'این بخش اجباریست',
            'video.mimes' => 'فرمت فایل پشتیبانی نمی شود',
            'video.max' => 'حجم ویدیو نمی تواند بیشتر از 7MB باشد'
        ];
    }
}
