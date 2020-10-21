<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show($slug1,$slug2 = null)
    {
        if ($slug2 == null)
        {
            $slug1 = str_replace('-',' ',$slug1);
            $course = Course::where('title',$slug1)->firstOrFail();
            $videos = $course->videos;
            return view('course.show')
                ->with('videos',$videos)
                ->with('course',$course);
        }
    }

}
