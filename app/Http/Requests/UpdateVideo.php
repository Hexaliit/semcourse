<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideo extends FormRequest
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
            'video' => 'mimes:mp4,mpeg,avi'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'عنوان ویدیو نمی تواند خالی باشد',
            'video.mimes' => 'فرمت فایل پشتیبانی نمی شود'
        ];
    }
}
